import { z, defineCollection } from 'astro:content';

const notesCollection = defineCollection({
    type: 'content',
    schema: z.object({
        title: z.string(),
        tags: z.array(z.string()),
        isDraft: z.boolean(),
        publishDate: z.string().datetime({ offset: true }).or(z.date()),
        updatedDate: z.string().datetime({ offset: true }).or(z.date()),
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
        // https://astrocourse.dev/blog/how-to-use-content-collections/
        publishDate: z.string().datetime({ offset: true }).or(z.date()),
    }),
});

export const collections = {
    'notes': notesCollection,
    'links': linksCollection,
};