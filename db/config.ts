import { column, defineDb, defineTable, NOW } from 'astro:db';

const ShaEntry = defineTable({
  columns: {
    id: column.number({ primaryKey: true }),
    username: column.text(),
    hash: column.text({ unique: true }),
    submitted: column.date({ default: NOW })
  }
})

// https://astro.build/db/config
export default defineDb({
  tables: { ShaEntry }
});
