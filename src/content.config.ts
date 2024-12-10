import { glob } from "astro/loaders";
import { defineCollection, z } from "astro:content";

const notes = defineCollection({
  loader: glob({ pattern: "**/*.md", base: "./src/notes" }),
  schema: z.object({
    title: z.string(),
    description: z.string(),
    draft: z.boolean().default(true),
    tags: z.array(z.string()),
    created_at: z.date(),
    // created_at: z.coerce.date(),
    updated_at: z.date().optional(),
    // updated_at: z.coerce.date().optional(),
  }),
});

export const collections = { notes };
