FROM php:7.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zip \
    unzip \
    iputils-ping \
    vim

RUN docker-php-ext-install pdo_mysql
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apt-get install -y --no-install-recommends supervisor

RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y --no-install-recommends nodejs

COPY ./supervisor/* /etc/supervisor/conf.d/
