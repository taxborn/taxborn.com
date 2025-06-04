import { defineCollection, z } from "astro:content";
import { glob } from "astro/loaders";

const notes = defineCollection({
  // TODO: Convert to or allow mdx?
  loader: glob({ base: "./src/notes", pattern: "**/*.md" }),
  schema: z.object({
    title: z.string(),
    draft: z.boolean().default(true),
    published_date: z.coerce.date(),
  }),
});

export const collections = { notes };
