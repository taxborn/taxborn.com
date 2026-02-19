// @ts-check
import { defineConfig, fontProviders } from "astro/config";

import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  csp: true,
  fonts: [
    {
      provider: fontProviders.bunny(),
      name: "JetBrains Mono",
      cssVariable: "--font-jetbrains-mono",
    },
  ],
  vite: {
    plugins: [tailwindcss()],
  },
});
