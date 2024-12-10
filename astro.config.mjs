// @ts-check
import { defineConfig } from "astro/config";
import tailwind from "@astrojs/tailwind";
import expressiveCode from "astro-expressive-code";

import sitemap from "@astrojs/sitemap";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  integrations: [tailwind(), expressiveCode({
    // TODO: I *have* to have all three of these to get the theme to generate for some reason...
    themes: ["catppuccin-mocha", "dracula", "andromeeda"]
  }), sitemap()],
  prefetch: {
    prefetchAll: true,
  },
  env: {
    schema: {},
  },
  markdown: {
    shikiConfig: {
      theme: "catppuccin-mocha",
    },
  },
});