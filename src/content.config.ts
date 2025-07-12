import { defineCollection, z } from "astro:content";
import { glob } from "astro/loaders";

const notes = defineCollection({
  loader: glob({ pattern: "**/*.md", base: "./notes" }),
  schema: z.object({
    title: z.string(),
    published: z.date(),
    tags: z.array(z.string()).optional(),
    draft: z.boolean().default(true),
  }),
});

export const collections = { notes };
