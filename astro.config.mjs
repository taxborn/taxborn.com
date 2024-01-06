import { defineConfig } from 'astro/config';
import vercel from '@astrojs/vercel/serverless';
import tailwind from "@astrojs/tailwind";

import mdx from "@astrojs/mdx";

// https://astro.build/config
export default defineConfig({
  output: 'server',
  adapter: vercel({
    webAnalytics: {
      enabled: true
    },
    imageService: true,
  }),
  integrations: [tailwind(), mdx()]
});