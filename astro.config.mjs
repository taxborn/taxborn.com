import { defineConfig } from "astro/config";
import rehypePrettyCode from "rehype-pretty-code";
import tailwind from "@astrojs/tailwind";
import node from "@astrojs/node";
import theme from "./catppuccin-color-scheme.json";
import mdx from "@astrojs/mdx";

const prettyCodeOptions = {
  theme,
  onVisitHighlightedLine(node) {
    node?.properties?.className
      ? node.properties.className.push("highlighted")
      : (node.properties.className = ["highlighted"]);
  },
  onVisitHighlightedChars(node) {
    console.log(node);
    node?.properties?.className
      ? node.properties.className.push("highlighted-chars")
      : (node.properties.className = ["highlighted-chars"]);
  },
  tokensMap: {},
};

// https://astro.build/config
export default defineConfig({
  integrations: [tailwind(), mdx()],
  output: "hybrid",
  markdown: {
    // extendDefaultPlugins: true,
    syntaxHighlight: false,
    rehypePlugins: [[rehypePrettyCode, prettyCodeOptions]],
    shikiConfig: {
      theme,
    },
  },

  adapter: node({
    mode: "standalone",
  }),
});
