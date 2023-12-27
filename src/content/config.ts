import { z, defineCollection } from 'astro:content';

const notesCollection = defineCollection({
    type: 'content',
    schema: z.object({
        title: z.string(),
        tags: z.array(z.string()),
        isDraft: z.boolean(),
        publishDate: z.date(),
        updatedDate: z.date(),
    }),
});

const linksCollection = defineCollection({
    type: 'content',
    schema: z.object({
        title: z.string(),
        tags: z.array(z.string()),
        url: z.string().url(),
        isDraft: z.boolean(),
        publishDate: z.date(),
    }),
});

export const collections = {
    'notes': notesCollection,
    'links': linksCollection,
};