FROM php:7.3-fpm

RUN apt-get update

RUN apt-get install -y libonig-dev libpq-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install zip pdo_mysql
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apt-get install -y --no-install-recommends supervisor

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y --no-install-recommends nodejs && \
    npm install -g npm

COPY ./supervisor/* /etc/supervisor/conf.d/
