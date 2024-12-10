// @ts-check
import { defineConfig } from "astro/config";
import tailwind from "@astrojs/tailwind";
import expressiveCode from "astro-expressive-code";
import sitemap from "@astrojs/sitemap";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  integrations: [
    tailwind(),
    sitemap(),
    expressiveCode({
      themes: ["catppuccin-mocha"],
    }),
  ],
  prefetch: {
    prefetchAll: true,
  },
  env: {
    schema: {},
  },
});
