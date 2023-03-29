FROM php:8.2-fpm-alpine

ENV TZ=UTC
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1

# Configure timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Add php extension installer script
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apk add --no-cache \
    unzip git curl

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions redis imagick bcmath calendar exif gd intl pdo_pgsql pcntl soap zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-scripts --prefer-dist --no-dev --optimize-autoloader && \
    rm -rf /root/.composer

COPY . ./
