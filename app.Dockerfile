FROM node:latest as build

WORKDIR /app

COPY package.json /app

COPY vite.config.js /app/vite.config.js

COPY resources /app/resources

RUN npm install

RUN npm update

RUN npm run build

FROM dwchiang/nginx-php-fpm:latest

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./docker/phpConf/php.ini /usr/local/etc/php/conf.d/php.ini
COPY  /docker/nginxConf/default.conf /etc/nginx/conf.d/*.conf

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --from=build /app/public /var/www/public

COPY --chown=www:www . /var/www

RUN chown www:www /var/www

USER www

RUN composer install

RUN chmod +x run.sh

RUN cp run.sh /tmp

ENTRYPOINT ["/tmp/run.sh"]
