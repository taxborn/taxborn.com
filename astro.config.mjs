// @ts-check
import { defineConfig } from 'astro/config';

import node from '@astrojs/node';
import tailwindcss from '@tailwindcss/vite';

// https://astro.build/config
export default defineConfig({
  adapter: node({
    mode: 'standalone'
  }),
  site: 'https://www.taxborn.com',

  // Declared only to make the session store path relative. Left implicit, the
  // Node adapter bakes an *absolute* base into the built manifest — under Nix
  // that is the build sandbox, `/build/source/node_modules/.astro/sessions`,
  // which does not exist at runtime. Naming the driver emits `.astro/session`
  // instead, resolved against the process working directory, which the systemd
  // unit points at its StateDirectory. `options.base` is deliberately absent:
  // Astro overrides it for this driver, so passing one only reads as if it
  // were doing something.
  session: { driver: 'fs-lite' },
  vite: {
    plugins: [tailwindcss()]
  }
});
