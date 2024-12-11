---
title: Setting up taxborn.com
description: Documenting setting up my website on an OVH VPS
draft: false
tags:
  - nginx
  - vps
  - ovh
  - web
created_at: 2024-10-11T14:11:00-06:00
updated_at: 2024-12-10T20:36:57-06:00
---
To start off some public notes and documenting what I learn, I decided to tackle setting up a fresh Ubuntu VPS to host my personal website, a side-project, and a small Minecraft server.

# Introduction
While I've been coding on and off since about 2013 (*nearly half my life now*), I spent **way** too much of that time following a YouTube tutorial series, copy and pasting code, and not doing any *real* learning. During my time in college, I learned the value of just parsing the standard library, learning my tools and learning how to use them well, and just creating something is a far greater than I initially thought it was.

Around the start of 2024 I got hooked on the [IndieWeb](https://indieweb.org) movement (introduced by the website [jvt.me](https://jvt.me), not sure how I initially found it, unfortunately) and creating my own personal garden. That, coupled with the trend now to move from the cloud back to self-hosting applications (*which is ironic given that I was on a project at work to move from self-hosting to the cloud...*), I really wanted to learn things on my own without relying on heavy infrastructure like [Vercel](https://vercel.com) and the like. 

With that I thought it would be a golden oppertunity to take the time to document setting up a VPS, securing it, while learning a bit about the web on the way. I will be setting all of this up on an [OVH](https://us.ovhcloud.com/) [Comfort VPS](https://us.ovhcloud.com/vps/compare/) running a fresh **Ubuntu 24.04** installation. Before getting into it, I should define a few requirements.
# Requirements
1. Two domains, HTTPS, www

I have two domains, **taxborn.com** and **braxtonfair.com**. I have the username **taxborn** everywhere, so I essentially 'brand' myself as such. I did also want to have my name as a domain in case I ever decided to ditch the name, but today is not that day. I want to redirect all traffic from **braxtonfair.com** -> https://www.taxborn.com.

I want to ensure all traffic is encrypted with SSL, and force www. I went back and forth on whether to have www.taxborn.com or the non-prefixed taxborn.com. Looked at a couple [\[1\]](https://developer.mozilla.org/en-US/docs/Web/URI/Authority/Choosing_between_www_and_non-www_URLs) [\[2\]](https://www.netlify.com/blog/2020/03/26/how-to-set-up-netlify-dns-custom-domains-cname-and-a-records/#options-for-bare-domains) resources and determined it was mostly [bikeshedding](https://bikeshed.com/) and went with www.taxborn.com.

2. Easy deployments and updates

I got to learn a lot about [GitHub Actions](https://docs.github.com/en/actions) at work during my internship.

3. Understand my setup

# VPS Cleanup
I have created notes on setting up a VPS already, and can be [found here](/note/ovh-vps-setup).

# Installing Nginx
As of writing, the default apt repository has Nginx version *1.24.0*, but checking the [nginx website downloads](https://nginx.org/en/download.html) shows a recent _mainline_ version 1.27.2. I want to use the latest mainline version (not the stable, [seems recommended to use mainline](https://serverfault.com/questions/715049/what-s-the-difference-between-the-mainline-and-stable-branches-of-nginx)), so we need to change which repository apt uses to download Nginx:

These commands are pulled from [nginx's instructions](https://nginx.org/en/linux_packages.html#Ubuntu).
## Mainline version (recommended)
If you want the latest and greatest, you can use the mainline version of Nginx. This branch may also have experimental modules and new bugs.
```bash title="Alacritty" showLineNumbers="false"
# install required packages
sudo apt install curl gnupg2 ca-certificates lsb-release ubuntu-keyring
# get the signing key
curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor \
    | sudo tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null
# install mainline packages
echo "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] \
http://nginx.org/packages/mainline/ubuntu `lsb_release -cs` nginx" \
    | sudo tee /etc/apt/sources.list.d/nginx.list
# ensure apt uses nginx's repos over apt's
echo -e "Package: *\nPin: origin nginx.org\nPin: release o=nginx\nPin-Priority: 900\n" \
    | sudo tee /etc/apt/preferences.d/99nginx
# install nginx and check version
sudo apt update
sudo apt install nginx
```
## Stable version
The only difference in this process is the 3rd command, setting the url to http://nginx.org/packages/ubuntu over http://nginx.org/packages/mainline/ubuntu.
```bash title="Alacritty" showLineNumbers="false"
# install required packages
sudo apt install curl gnupg2 ca-certificates lsb-release ubuntu-keyring
# get the signing key
curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor \
    | sudo tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null
# install stable packages
echo "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] \
http://nginx.org/packages/ubuntu `lsb_release -cs` nginx" \
    | sudo tee /etc/apt/sources.list.d/nginx.list
# ensure apt uses nginx's repos over apt's
echo -e "Package: *\nPin: origin nginx.org\nPin: release o=nginx\nPin-Priority: 900\n" \
    | sudo tee /etc/apt/preferences.d/99nginx
# install nginx and check version
sudo apt update
sudo apt install nginx
```
# Creating a site to host
***TODO**: I want to explore using Docker, K8s, or [Earthly](https://earthly.dev/), so I may come back and update this part for that.*

I already have a website I want to host, [taxborn.com](https://github.com/taxborn/taxborn.com). This is a website created with [Astro](https://astro.build). On their website, Astro describes itself as:
> **Astro** is a JavaScript web framework optimized for building fast, content-driven websites.

I have had a great experience with the framework, and love the fast outputs. It has the option to output a statically-generated website (SSG), or output to a server (in my case, Node.JS).

Start by creating a `/var/www` folder: `sudo mkdir -p /var/www`. This is where our website will live. We then need to setup permissions for the **www** folder. `sudo chown -R ubuntu:www-data /var/www`, which allows the `ubuntu` user and the `www-data` user group to own this directory. Also, add the `ubuntu` user to the `www-data` group `sudo usermod -aG www-data ubuntu`.

We can then `cd /var/www`, and clone the repo we want to use (e.g. `git clone https://github.com/taxborn/taxborn.com`).
## Getting Node
I've recently been enjoying using [fnm](https://github.com/Schniz/fnm), so will install the latest Node version through that. `fnm use --install-if-missing 22`.

*I eventually want to use deploy keys and GitHub Actions CI/CD so this way of updating the website will change.*

Then it's just a matter of installing the dependencies and building: `npm i && npm run build`. The built website is in the `dist/` folder. To run my website, I execute the command `node dist/server/entry.mjs`, which results in:
```bash title="Alacritty" showLineNumbers="false"
01:23:43 [@astrojs/node] Server listening on http://localhost:4321
```
The website is running on the VPS on port **4321**. We can't access this quite yet, we are going to configure Nginx as a [reverse proxy](https://en.wikipedia.org/wiki/Reverse_proxy) (cloudflare has a [nice article about this](https://www.cloudflare.com/learning/cdn/glossary/reverse-proxy/)) as a [TLS termination proxy](https://en.wikipedia.org/wiki/TLS_termination_proxy) to handle **https** traffic.

This allows our Node application to *not* have to handle https communication itself, allowing some performance gains (*I should really benchmark this claim, though*).
## DNS
I already have my domains (*taxborn.com* and *braxtonfair.com*) verified with OVH and pointing at this server. Currently not being proxied through Cloudflare but will turn that on later. TTL is set to **1 day** and I set both **A** and **AAAA** records.
# Configuring Nginx
The configuration files for Nginx (at least in Ubuntu, likely in other distributions) lay in `/etc/nginx`. Let's make sure we have 2 folders available to us, `sudo mkdir /etc/nginx/sites-available` and `sudo mkdir /etc/nginx/sites-enabled`. We can create a config for **taxborn.com** with `sudo vim /etc/nginx/sites-available/www.taxborn.com`:

```nginx title="/etc/nginx/sites-available/www.taxborn.com"
server {
    listen 80;
    server_name taxborn.com www.taxborn.com 15.204.234.44;

    location / {
        proxy_pass http://localhost:4321;
        proxy_http_version 1.1; # TODO: how does HTTP/2 perform?
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Optional: Add logging
    access_log /var/log/nginx/your_app_access.log;
    error_log /var/log/nginx/your_app_error.log;
}
```
Let's now enable the site www.taxborn.com by creating a symlink `sudo ln -s /etc/nginx/sites-available/www.taxborn.com /etc/nginx/sites-enabled/`, and ensure our nginx configuration loads the site `sudo vim /etc/nginx/nginx.conf`
```nginx title="/etc/nginx/sites-available/www.taxborn.com"
user  nginx;
worker_processes  auto;

error_log  /var/log/nginx/error.log notice;
pid        /var/run/nginx.pid;

events {
    worker_connections  1024;
}

http {
    include       /etc/nginx/mime.types;
    default_type  application/octet-stream;

    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

    access_log  /var/log/nginx/access.log  main;
    sendfile        on;
    #tcp_nopush     on;

    keepalive_timeout  65;
    #gzip  on;

    # include /etc/nginx/conf.d/*.conf;
    include /etc/nginx/sites-enabled/*;
}
```
I plan to thoroughly document these settings soon, in a seperate note. To ensure your configuration is valid, run `sudo nginx -t`, and if all is well, restart with `sudo systemctl restart nginx`.

From there, we need to ensure our firewall allows traffic over port 80, really easy with ufw: `sudo ufw allow 80/tcp` and `sudo ufw reload`. Now I can access my website at http://15.204.234.44.
## Generating an SSL certificate
[Certbot]() AKA LetsEncrypt has been my go-to for this for a while. Before we get too far, let's ensure that we also allow traffic over port 443, with `sudo ufw allow 443/tcp && sudo ufw reload`.

Installing certbot is easy, `sudo apt install certbot python3-certbot-nginx`. From there, we can generate an SSL certificate with the following command: `sudo certbot --nginx -d taxborn.com -d www.taxborn.com`. Let certbot do it's thing, and you should see something like the following at the end:
```console title="Alacritty"
Successfully received certificate.
Certificate is saved at: /etc/letsencrypt/live/taxborn.com/fullchain.pem
Key is saved at:         /etc/letsencrypt/live/taxborn.com/privkey.pem
This certificate expires on 2025-01-11.
These files will be updated when the certificate renews.
Certbot has set up a scheduled task to automatically renew this certificate in the background.

Deploying certificate
Successfully deployed certificate for taxborn.com to /etc/nginx/sites-enabled/www.taxborn.com
Successfully deployed certificate for www.taxborn.com to /etc/nginx/sites-enabled/www.taxborn.com
Congratulations! You have successfully enabled HTTPS on https://taxborn.com and https://www.taxborn.com
```
The file at `/etc/nginx/sites-available/www.taxborn.com` should look a bit different now:
```nginx title="/etc/nginx/sites-available/www.taxborn.com"
server {
    server_name taxborn.com www.taxborn.com;

    location / {
        proxy_pass http://localhost:4321;
        proxy_http_version 1.1; # TODO: how does HTTP/2 perform?
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Optional: Add logging
    access_log /var/log/nginx/your_app_access.log;
    error_log /var/log/nginx/your_app_error.log;

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/taxborn.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/taxborn.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}

server {
    if ($host = www.taxborn.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    if ($host = taxborn.com) {
        return 301 https://$request_uri;
    } # managed by Certbot

    listen 80;
    server_name taxborn.com www.taxborn.com;
    return 404; # managed by Certbot
}
```
A little messy, I am going to clean that up a bit and add some comments...
```nginx title="/etc/nginx/sites-available/www.taxborn.com"
# HTTP Server block - responsible for upgrading all http:// traffic to https://www.taxborn.com
server {
    listen 80;
    server_name taxborn.com www.taxborn.com;

    if ($host = www.taxborn.com) {
        return 301 https://$host$request_uri;
    }

    if ($host = taxborn.com) {
        return 301 https://www.$$request_uri;
    }

    return 404;
}

# HTTPS Server block - responsible for handling the SSL certificate
server {
    listen 443 ssl; # managed by Certbot
    server_name taxborn.com www.taxborn.com;

    # OPTIONAL: I like to enforce the www subdomain
    if ($host = taxborn.com) {
        return 301 https://www.taxborn.com$request_uri;
    }

    # Reverse proxy for our node application being hosted locally on port 4321
    location / {
        proxy_pass http://localhost:4321;
        proxy_http_version 1.1; # TODO: how does HTTP/2 perform?
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Optional: Add logging
    access_log /var/log/nginx/taxborn_access.log;
    error_log /var/log/nginx/taxborn_error.log;

    # SSL options
    ssl_certificate /etc/letsencrypt/live/taxborn.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/taxborn.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}
```
Much better... again test the config with an `sudo nginx -t` and reload with `sudo systemctl restart nginx`.

## SSL
Mozilla provides a [helpful resource](https://ssl-config.mozilla.org/) for some reasonable SSL defaults in an Nginx config. Let's incorporate those recommendations.

*They also have configurations for various server software like Apache, HAProxy, etc...*

```nginx title="/etc/nginx/sites-available/www.taxborn.com"
# HTTP Server block - responsible for upgrading all http:// traffic to https://www.taxborn.com
server {
    listen 80;
    listen [::]:80;
    server_name taxborn.com www.taxborn.com;

    location / {
        return 301 https://www.taxborn.com$request_uri;
    }
}

# HTTPS Server block - responsible for handling the SSL certificate
server {
    listen 443 ssl;
    listen [::]:443 ssl;
    server_name taxborn.com www.taxborn.com;

    # enable http2
    http2 on;

    ssl_certificate /etc/letsencrypt/live/taxborn.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/taxborn.com/privkey.pem;
    ssl_session_timeout 1d;
    ssl_session_cache shared:MozSSL:10m; # about 40k sessions

    # curl https://ssl-config.mozilla.org/ffdhe2048.txt > /path/to/dhparam
    ssl_dhparam /etc/nginx/dhparam;

    # HSTS and Preload
    add_header Strict-Transport-Security "max-age=63072000; includeSubdomains; preload" always;
    add_header Content-Security-Policy "frame-ancestors 'none'" always;
    add_header X-Frame-Options "DENY" always;
    add_header X-Content-Type-Options "nosniff" always;

    # OCSP stapling
    ssl_stapling on;
    ssl_stapling_verify on;

    # intermediate *configuration*
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:DHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-CHACHA20-POLY1305;
    ssl_prefer_server_ciphers off;

    # OPTIONAL: I like to enforce the www subdomain
    if ($host = taxborn.com) {
        return 301 https://www.taxborn.com$request_uri;
    }

    # Reverse proxy for our node application being hosted locally on port 4321
    location / {
        proxy_pass http://localhost:4321;
        proxy_http_version 1.1; # TODO: how does HTTP/2 perform?
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Optional: Add logging
    access_log /var/log/nginx/taxborn_access.log;
    error_log /var/log/nginx/taxborn_error.log;
}
```

# Testing our configuration 
There are a few resources I use to test my website configuration.
1. [MDN's HTTP Observatory](https://developer.mozilla.org/en-US/observatory) - ensure proper headers are setup.
2. [Qualys SSL Labs](https://www.ssllabs.com/) - test SSL configuration to ensure a secure setup.
3. [Probely Security Headers](https://securityheaders.com/) - another headers check.

# Conclusion
That's about what it took for me to deploy my web application on a VPS with Nginx and secured with HTTPS. I will issue a few more updates to this as I learn more but that got me to a place where I was initially happy.