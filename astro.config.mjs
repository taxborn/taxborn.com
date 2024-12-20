// @ts-check
import { defineConfig } from "astro/config";
import tailwind from "@astrojs/tailwind";
import expressiveCode from "astro-expressive-code";
import { pluginLineNumbers } from "@expressive-code/plugin-line-numbers";
import sitemap from "@astrojs/sitemap";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  // HEY: Ensure compressor() is the last integration to ensure everything is compressed
  integrations: [
    tailwind(),
    sitemap(),
    expressiveCode({
      themes: ["catppuccin-macchiato"],
      plugins: [pluginLineNumbers()],
      defaultProps: {
        showLineNumbers: true,
        overridesByLang: {
          "console,bash": {
            showLineNumbers: false,
          },
        },
      },
    }),
  ],
  prefetch: {
    prefetchAll: true,
  },
  env: {
    schema: {},
  },
  redirects: {
    "/note": "/notes",
  },
});
