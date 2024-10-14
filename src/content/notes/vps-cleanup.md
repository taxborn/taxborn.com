---
title: Setting up a clean VPS
isDraft: true
tags:
- vps
- web development
- linux
created: 2024-10-11T18:20:34-05:00
---

# Updates
First thing I do is change the `ubuntu` user password, and update the system.

1. `passwd`, save this JIC, I use 1Password.
2. `sudo apt update && sudo apt upgrade -y`

Then I `reboot` the system. It's good to make sure everything is up-to-date.
# SSH and security
First thing is to copy over my SSH keys to the server. On my local machine, type `ssh-copy-id ubuntu@15.204.234.44`, re-enter the user's password and you're good to go with SSH!
## Local SSH settings
To make it just *that* much easier to work with, I edited my local SSH configuration `~/.ssh/config` to save the server I am working on:
```
Host word # name your server whatever
	HostName 15.204.234.44 # your server IP
	# Port 22 # only needed if you change your default SSH port, assumes 22
	User ubuntu
	# IdentityFile ~/.ssh/... # in case you have multiple SSH keys
```
Once that is set, I can simply SSH into the server with `ssh word`, great!
## Server SSH settings
We really want to secure our main entrypoint to the server, and there are a couple strategies for that. Disabling password authentication, root user access, among others.

SSH into the server, and we want to edit the ssh**d** file, `sudo vim /etc/ssh/sshd_config`. Ensure the following settings are turned toggled as such:
```
# Disable sign in attemps as the `root` user
PermitRootLogin no
# Max authn attempts for a login session
MaxAuthTries 3
# A value in *seconds* in which a user has to complete authn.
# Helps prevent some denial-of-service attacks
LoginGraceTime 20
# Disable password authn, and disallow blank passwords
PasswordAuthentication no
PermitEmptyPasswords no
```
then reload the service to apply the settings, `sudo systemctl reload ssh`.
## Firewall
**WARNING:** Once enabled, **MAKE SURE** SSH is allowed through the firewall, else you risk being locked out if your VPS provider doesn't give you some other means of accessing the VPS.

As for the software, I am going to just go with the default `ufw`. Enable it with `sudo ufw enable`, and enable SSH access with `sudo ufw allow OpenSSH`. You might want to ensure the OpenSSH app specifies the correct port, and you can check that with `sudo ufw app info OpenSSH`, which will output something similar to the following:
```
Profile: OpenSSH
Title: Secure shell server, an rshd replacement
Description: OpenSSH is a free implementation of the Secure Shell protocol.

Port:
  22/tcp
```
This enables traffic over port 22, exactly what I need. Reload the firewall with `sudo ufw reload` and we should be good to go. Reboot the server and hope you can get back in.
## Fail2Ban
I should do more research on this, but seems recommended and standard.
`sudo apt install fail2ban`
