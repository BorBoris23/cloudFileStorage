FROM nginx:latest

WORKDIR /var/www

COPY . .

COPY /docker/nginxConf/default.conf /etc/nginx/conf.d/default.conf


