// @ts-check
import { defineConfig } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  site: "https://www.taxborn.com",
  // experimental: {
  //   csp: true,
  // },
  vite: {
    plugins: [tailwindcss()],
  },
});
