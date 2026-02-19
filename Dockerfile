FROM node:lts-alpine AS build
ARG COMMIT_HASH
ARG COMMIT_DATE
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN COMMIT_HASH=$COMMIT_HASH COMMIT_DATE=$COMMIT_DATE npm run build

FROM nginx:alpine AS runtime
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY --from=build /app/dist /usr/share/nginx/html
# keep in sync with https://git.mischief.town/nix-infra/nixcfg/src/branch/main/modules/nixos/services/taxborn-com/default.nix#L17
EXPOSE 8080
