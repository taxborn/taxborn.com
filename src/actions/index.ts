import { defineAction } from "astro:actions";
import { z } from "astro:schema";
import { db, Entries } from "astro:db";
import { sha256 } from "js-sha256";

export const server = {
  shaEntry: defineAction({
    accept: "form",
    input: z.object({
      entry: z
        .string()
        .regex(
          /^[A-Za-z0-9-_=]{1,32}\/[A-Za-z0-9-_=]{1,64}$/,
          "String does not match regex",
        ),
    }),
    handler: async (input) => {
      // TODO: Insert into database, determine if in top 100
      await db
        .insert(Entries)
        .values({ entry: input.entry, hash: sha256(input.entry) });
      return `${input.entry}`;
    },
  }),
};
