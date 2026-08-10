{
  lib,
  stdenv,
  importNpmLock,
  makeWrapper,
  nodejs_22,
}:

let
  # Pinned rather than tracking `pkgs.nodejs`, which is already a major ahead.
  # `engines` in package.json and the runner in .forgejo/workflows/ci.yaml both
  # say 22, and the point of building this here is that CI's green tick and the
  # thing Carbon actually runs were produced the same way.
  nodejs = nodejs_22;

  libDir = "lib/taxborn-com";
in
stdenv.mkDerivation (finalAttrs: {
  pname = "taxborn-com";
  version = "0.0.1";

  # Only what the build reads. `src = ./.` would work — a flake copies just the
  # git-tracked files, so node_modules and dist are excluded either way — but it
  # would also put README.md, CLAUDE.md and the CI workflow in the input hash,
  # and rebuild the site whenever prose changes.
  src = lib.fileset.toSource {
    root = ./.;
    fileset = lib.fileset.unions [
      ./astro.config.mjs
      ./package.json
      ./package-lock.json
      ./public
      ./src
      ./tsconfig.json
    ];
  };

  nativeBuildInputs = [
    # Pairs with `buildNodeModules` below, and the pairing is not
    # interchangeable: this symlinks a prebuilt node_modules into the build
    # directory, where `npmConfigHook` would instead expect the raw sources
    # derivation and run `npm ci` itself. Crossing the two gets an offline npm
    # trying to reach registry.npmjs.org and failing with ENOTCACHED.
    importNpmLock.hooks.linkNodeModulesHook
    makeWrapper
    nodejs
  ];

  # `importNpmLock` rather than `buildNpmPackage`: it reads package-lock.json
  # directly and fetches each tarball as its own fixed-output derivation, so
  # there is no `npmDepsHash` to regenerate every time a dependency moves. That
  # hash is the part of a Node package that rots — it fails the build with a
  # mismatch long after whoever bumped the dependency has stopped looking.
  #
  # Building the modules as their own derivation also means editing a component
  # rebuilds the site alone; the dependency tree is only reassembled when the
  # lockfile itself changes.
  npmDeps = importNpmLock.buildNodeModules {
    npmRoot = ./.;
    inherit nodejs;
  };

  # Astro phones home on build unless told not to, and writes the opt-out state
  # under $HOME — neither of which works in a sandbox.
  env.ASTRO_TELEMETRY_DISABLED = "1";

  buildPhase = ''
    runHook preBuild
    npm run build
    runHook postBuild
  '';

  # node_modules sits beside dist, and that is load-bearing. The Node adapter
  # externalizes dependencies instead of bundling them, so dist/server/entry.mjs
  # still carries bare imports (`astro/...`) that Node resolves at runtime by
  # walking up from the entry file's own directory. Installing dist alone builds
  # perfectly and then dies with ERR_MODULE_NOT_FOUND on the first start.
  #
  # It is a symlink to the modules derivation rather than a copy: that tree is
  # already a complete node_modules in the store, and Node resolves through the
  # link happily. Copying would put a second couple of hundred megabytes in the
  # closure to no end. There are no devDependencies in package.json, so this is
  # the production tree as-is, with nothing to prune.
  installPhase = ''
    runHook preInstall

    mkdir -p $out/${libDir}
    cp -r dist $out/${libDir}/
    ln -s ${finalAttrs.npmDeps}/node_modules $out/${libDir}/node_modules

    makeWrapper ${lib.getExe nodejs} $out/bin/taxborn-com \
      --add-flags $out/${libDir}/dist/server/entry.mjs

    runHook postInstall
  '';

  meta = {
    description = "taxborn.com, served by Astro's Node adapter in standalone mode";
    homepage = "https://www.taxborn.com";
    mainProgram = "taxborn-com";
    platforms = lib.platforms.linux;
  };
})
