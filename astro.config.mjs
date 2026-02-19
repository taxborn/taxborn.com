// @ts-check
import { defineConfig, fontProviders } from "astro/config";
import node from "@astrojs/node";
import tailwindcss from "@tailwindcss/vite";

// https://astro.build/config
export default defineConfig({
  output: "server",
  adapter: node({
    mode: "standalone",
  }),
  security: {
    csp: true,
  },
  fonts: [
    {
      provider: fontProviders.bunny(),
      name: "JetBrains Mono",
      cssVariable: "--font-jetbrains-mono",
    },
  ],
  server: {
    host: true,
    port: 8080,
  },
  vite: {
    plugins: [tailwindcss()],
  },
});
