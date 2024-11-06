FROM php:8.3-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS \
  bash \
  wget \
  git \
  unzip \
  busybox-extras \
  linux-headers \
  gcc \
  make \
  autoconf \
  postgresql-dev \
&& pecl install xdebug-3.3.2 \
&& docker-php-ext-enable xdebug \
&& docker-php-ext-install \
  pdo \
  pdo_mysql \
  pdo_pgsql \
  mysqli \
  bcmath \
  sockets
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer \
