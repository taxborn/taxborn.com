import { defineCollection, z } from 'astro:content';

const noteCollection = defineCollection({
    type: 'content',
    schema: z.object({
        title: z.string(),
        isDraft: z.boolean().default(true),
        tags: z.array(z.string()),
        created: z.date()
    })
});

export const collections = {
  'notes': noteCollection,
};