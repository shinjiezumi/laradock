FROM php:7.3-fpm

RUN apt-get update

RUN apt-get install -y libonig-dev libpq-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install zip pdo_mysql pdo_pgsql
RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug
RUN apt-get install -y --no-install-recommends supervisor

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y --no-install-recommends nodejs

COPY ./supervisor/* /etc/supervisor/conf.d/
