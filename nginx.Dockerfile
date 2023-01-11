FROM node:latest as build

WORKDIR /app

COPY package.json /app
COPY vite.config.js /app/vite.config.js
COPY tailwind.config.js /app/tailwind.config.js
COPY postcss.config.js /app/postcss.config.js
COPY resources /app/resources

RUN npm install
RUN npm update
RUN npm run build

FROM nginx:latest

WORKDIR /var/www
COPY /public /var/www/public
COPY --from=build /app/public /var/www/public
COPY /docker/nginxConf/default.conf /etc/nginx/conf.d/default.conf
