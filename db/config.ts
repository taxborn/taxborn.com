import { column, defineDb, defineTable, NOW } from 'astro:db';

const ShaEntry = defineTable({
  columns: {
    id: column.number({ primaryKey: true }),
    username: column.text(),
    input: column.text({ unique: true }),
    hash: column.text(),
    submitted: column.date({ default: NOW })
  }
})

// https://astro.build/db/config
export default defineDb({
  tables: { ShaEntry }
});
