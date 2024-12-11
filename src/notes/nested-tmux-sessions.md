---
title: Handling nested Tmux sessions
description: I had issues working with nested Tmux sessions
draft: false
tags:
  - tmux
  - ssh
created_at: 2024-10-01T14:10:17-06:00
updated_at: 2024-12-10T18:45:04-06:00
---

# Handling nested Tmux sessions

I usually like to use tmux locally, and on word (my VPS) I run a tmux session to have both my website and the Minecraft server perpetually running.

The problem arises when trying to use tmux keybinds, where I am in a tmux session locally, SSH into a VPS I own, and open that tmux session. The key combinations do not work, however, I learned if I pressed the prefix combination `<C-b>` twice, or `<C-b-b>`, it executes the keybind in the nested session!
