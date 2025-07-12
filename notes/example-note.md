---
title: Example Note
published: 2025-07-11T17:59:28-05:00
tags: ["example", "note", "javascript", "rust", "programming", "brainfuck"]
---

Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.

## Here's something

Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.

<!-- Example image using placeholder service -->
![Example Image](https://via.placeholder.com/150)

```js
console.log('Hello World!');
```

```rust
fn main() {
    println!("Hello World!");
    // smallest brainfuck interpreter
    let input = "++++++++[>+++++++<-]>+.>++.+++++++..+++.>>.<-.<.+++.------.--------.>>+.>++.";
    let mut memory = [0; 30000];
    let mut pointer = 0;
    let mut instruction_pointer = 0;

    while instruction_pointer < input.len() {
        match input[instruction_pointer] {
            '>' => pointer += 1,
            '<' => pointer -= 1,
            '+' => memory[pointer] = memory[pointer].wrapping_add(1),
            '-' => memory[pointer] = memory[pointer].wrapping_sub(1),
            '.' => print!("{}", memory[pointer] as char),
            ',' => memory[pointer] = std::io::stdin().bytes().next().unwrap().unwrap(),
            '[' => {
                if memory[pointer] == 0 {
                    let mut depth = 1;
                    while depth > 0 {
                        instruction_pointer += 1;
                        match input[instruction_pointer] {
                            '[' => depth += 1,
                            ']' => depth -= 1,
                            _ => {}
                        }
                    }
                }
            }
            ']' => {
                if memory[pointer] != 0 {
                    let mut depth = 1;
                    while depth > 0 {
                        instruction_pointer -= 1;
                        match input[instruction_pointer] {
                            '[' => depth -= 1,
                            ']' => depth += 1,
                            _ => {}
                        }
                    }
                }
            }
            _ => {}
        }
        instruction_pointer += 1;
    }
}
```
