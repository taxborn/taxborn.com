// @ts-check
import { defineConfig } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

const isProduction = process.env.NODE_ENV === "production";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  experimental: {
    csp: isProduction,
  },
  vite: {
    plugins: [tailwindcss()],
  },
});
