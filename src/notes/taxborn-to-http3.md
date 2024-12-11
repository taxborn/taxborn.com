---
title: Upgrading taxborn.com to HTTP/3
description: Upgrading my website, behind Nginx, to utilize HTTP/3, AKA QUIC
draft: false
tags:
  - web
  - nginx
  - http/3
created_at: 2024-10-13T00:10:42-06:00
updated_at: 2024-12-10T19:42:07-06:00
---

This was a super easy upgrade. [Atul Kumar Pandey had a straightforward article](https://www.atulhost.com/enable-http3-in-nginx) on this.

# The old config:
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
}
```

# The **NEW** Config
This mostly is just adding a few more port 443 listeners for quic, toggle the http3 directive on, and add a couple headers.

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
    listen 443 quic reuseport;
    listen [::]:443 quic reuseport;

    server_name taxborn.com www.taxborn.com;

    # enable http2
    http2 on;

    # http3
    http3 on;
    quic_retry on;
    # Add http/3 headers. Move these headers where others are located.
    add_header Alt-Svc 'h3=":$server_port"; ma=86400';
    add_header x-quic 'h3';
    ssl_early_data on; # 0-RTT

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

    # intermediate configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:E
    CDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:DHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-CHACHA20-POLY1305;
    ssl_prefer_server_ciphers off;

    # OPTIONAL: I like to enforce the www subdomain
    if ($host = taxborn.com) {
        return 301 https://www.taxborn.com$request_uri;
    }

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
