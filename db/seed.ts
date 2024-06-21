import { db, ShaEntry } from 'astro:db';

// https://astro.build/db/seed
export default async function seed() {
	await db.insert(ShaEntry).values([
		{ id: 1, username: "taxborn/hi+taxborn+com/75880", hash: "00004814ff68878a34249aafaf4ca7fe83a8da4361a23210a44296eecadf2c80" },
		{ id: 2, username: "taxborn/i+lt3+you/93012941", hash: "00000007ed1568b5e2afdd493eb86b0b711bc27633150031267455222f234d34" },
		{ id: 3, username: "seletskiy/Hire+me/Hi+HackerNews/19GHsRTX4090G0hE1Zkb2+2", hash: "0000000000000136fb668ff8bdd6b08962d95af8717e6d0bd88dd107938e68f0" }
	])
}
