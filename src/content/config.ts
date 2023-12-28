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
    type: 'data',
    schema: z.object({
        title: z.string(),
        tags: z.array(z.string()),
        url: z.string().url(),
        isDraft: z.boolean(),
        // Using this because I don't understand how to use z.date()
        // with the 'data' collection type. one day I will understand,
        // not today.
        publishDate: z.string().transform((str) => new Date(str)),
    }),
});

export const collections = {
    'notes': notesCollection,
    'links': linksCollection,
};