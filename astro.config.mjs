// @ts-check
import { defineConfig, fontProviders } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

const isProduction = process.env.NODE_ENV === "production";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  trailingSlash: "always",
  experimental: {
    csp: isProduction,
    fonts: [
      {
        provider: fontProviders.google(),
        name: "JetBrains Mono",
        cssVariable: "--font-jetbrains-mono",
      },
      {
        provider: fontProviders.google(),
        name: "Atkinson Hyperlegible",
        cssVariable: "--font-atkinson",
      },
    ],
  },
  vite: {
    plugins: [tailwindcss()],
  },
});
