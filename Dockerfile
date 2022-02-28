ARG PHP_VERSION=8.1

FROM php:${PHP_VERSION}-apache AS base

COPY tools/docker/php/root /

WORKDIR /var/www/html

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    libpng-dev \
    mariadb-client \
  && docker-php-ext-install \
    bcmath \
    gd \
    pdo_mysql \
  && rm -fr /var/lib/apt/lists/*

###

FROM base AS install-dependencies

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    unzip \
  && rm -fr /var/lib/apt/lists/*

ENV PATH=$PATH:/var/www/html/vendor/bin

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN useradd drupal --create-home \
  && chown drupal:drupal -R /var/www/html

USER drupal

COPY --chown=drupal:drupal composer.* ./

RUN composer install

COPY --chown=drupal:drupal . .
