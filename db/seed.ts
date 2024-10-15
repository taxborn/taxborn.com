import { db, Entries } from "astro:db";
import * as crypto from "node:crypto";
import { sha256 } from "js-sha256";

export default async function () {
  for (var i = 0; i < 100; i++) {
    const id = crypto.randomBytes(5).toString("hex");
    const entry = `taxborn/${id}`;

    await db
      .insert(Entries)
      .values([{ id: i, entry: entry, hash: sha256(entry) }]);
  }
}
