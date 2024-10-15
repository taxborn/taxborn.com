import { defineDb, defineTable, column } from "astro:db";

const Entries = defineTable({
  columns: {
    id: column.number({ primaryKey: true }),
    entry: column.text(),
    hash: column.text(),
  },
});

export default defineDb({
  tables: { Entries },
});
