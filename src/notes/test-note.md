---
title: "Welcome to my blog"
published_date: 2025-06-03T18:00:00-0500
draft: true # always keep true, this is a test note
---
This intends to serve as a test note to demonstrate **Markdown** on my website.
Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores,
tenetur? Quia dicta quos voluptas est, hic eligendi cumque praesentium
quo quisquam, dignissimos commodi, fuga quis ratione nihil earum
necessitatibus voluptatum?

I don't intend to [write][website] with many headings, but when I do:

## I should only H2's and above.

This is because each website should onlye have **one H1 heading**.

```c
static uint8_t unicode_codepoint_length(uint8_t input) {
    // 1-byte case, 0b0xxx'xxxx
    if ((input & 0x80) == 0x00) return 1;
    // 2-byte case, 0b110x'xxxx
    if ((input & 0xE0) == 0xC0) return 2;
    // 3-byte case, 0b1110'xxxx
    if ((input & 0xF0) == 0xE0) return 3;
    // 4-byte case, 0b1111'0xxx
    if ((input & 0xF8) == 0xF0) return 4;

    // not valid
    return 0;
}
```

[website]: https://www.taxborn.com
