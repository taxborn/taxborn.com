// @ts-check
import { defineConfig, fontProviders } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  prefetch: {
    prefetchAll: true,
  },
  experimental: {
    fonts: [
      {
        provider: fontProviders.google(),
        name: "Atkinson Hyperlegible Next",
        cssVariable: "--font-atkinson-hyperlegible",
      },
    ],
  },
  vite: {
    plugins: [tailwindcss()],
  },
});
