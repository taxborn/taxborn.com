// @ts-check
import { defineConfig, fontProviders } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  vite: {
    plugins: [tailwindcss()],
  },
  experimental: {
    fonts: [
      {
        provider: fontProviders.fontsource(),
        name: "Atkinson Hyperlegible Next",
        cssVariable: "--font-atkinson-hyperlegible-next",
      },
      {
        provider: fontProviders.fontsource(),
        name: "Atkinson Hyperlegible Mono",
        cssVariable: "--font-atkinson-hyperlegible-mono",
      },
    ],
  },
});
