FROM php:8.2-fpm-alpine as base

ARG HOST_USER_ID=1000
ARG HOST_GROUP_ID=1000

ENV TZ=UTC
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0"
ENV PHP_OPCACHE_MAX_ACCELERATED_FILES="10000"
ENV PHP_OPCACHE_MEMORY_CONSUMPTION="192"
ENV PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
ENV HOST_USER_ID=$HOST_USER_ID
ENV HOST_GROUP_ID=$HOST_GROUP_ID

# Configure timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Add php extension installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apk add --no-cache \
    unzip git curl

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions redis imagick bcmath calendar exif gd intl pdo_mysql pcntl soap zip opcache

# Copy
COPY .docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-scripts --prefer-dist --no-dev --optimize-autoloader && \
    rm -rf /root/.composer


FROM base as development
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1"
COPY --chown=${HOST_USER_ID}:${HOST_GROUP_ID} . ./
USER ${HOST_USER_ID}
CMD ["php-fpm"]


FROM base as production
COPY --chown=${HOST_USER_ID}:${HOST_GROUP_ID} . ./
USER ${HOST_USER_ID}
CMD ["php-fpm"]
