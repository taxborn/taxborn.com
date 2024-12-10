// @ts-check
import { defineConfig } from 'astro/config';
import tailwind from '@astrojs/tailwind';
import expressiveCode from 'astro-expressive-code';

// https://astro.build/config
export default defineConfig({
  site: 'https://www.taxborn.com',
  integrations: [tailwind(), expressiveCode({
    themes: ['catppuccin-mocha', 'dracula', 'andromeeda']
  })],
  prefetch: {
    prefetchAll: true,
  },
  env: {
    schema: {},
  },
  markdown: {
    shikiConfig: {
      theme: 'catppuccin-mocha'
    }
  }
});