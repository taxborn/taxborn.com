import rss from "@astrojs/rss";
import type { APIContext } from "astro";
import { getCollection } from "astro:content";
import type { CollectionEntry } from "astro:content";

export async function GET(context: APIContext) {
  const notes: CollectionEntry<"notes">[] = await getCollection(
    "notes",
    (note: CollectionEntry<"notes">) => {
      return import.meta.env.PROD ? note.data.draft !== true : true;
    },
  );

  return rss({
    title: "taxborn.com - Braxton's notes",
    description:
      "A collection of organized, and disorganized notes in computer science, math, and my life.",
    site: context.site ?? "https://www.taxborn.com",
    items: notes.map((note) => ({
      title: note.data.title,
      description: note.data.description,
      pubDate: note.data.created_at,
      link: `/note/${note.id}`,
    })),
    customData: `<language>en-us</language>`,
  });
}
