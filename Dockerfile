FROM node:lts-alpine AS build
ARG COMMIT_HASH
ARG COMMIT_DATE
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN COMMIT_HASH=$COMMIT_HASH COMMIT_DATE=$COMMIT_DATE npm run build

FROM node:lts-alpine AS runtime
WORKDIR /app
COPY --from=build /app/dist ./dist
COPY --from=build /app/node_modules ./node_modules
# keep in sync with https://git.mischief.town/nix-infra/nixcfg/src/branch/main/modules/nixos/services/taxborn-com/default.nix#L17
EXPOSE 8080
ENV HOST=0.0.0.0
ENV PORT=8080
CMD ["node", "./dist/server/entry.mjs"]
