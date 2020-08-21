FROM php:7.4.9-fpm-alpine3.12

RUN apk --update add --no-cache \
    ${PHPIZE_DEPS} \
    oniguruma-dev \
    libpng-dev \
    openssl-dev \
    gd \
    libxml2-dev \
    git \
    nodejs \
    nodejs-npm \
    && rm -rf /var/cache/apk/*


RUN docker-php-ext-install \
        mbstring \
        gd \
        soap \
        xml \
        posix \
        tokenizer \
        ctype \
        pcntl \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug \
        && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && pecl install -f mongodb \
        && echo 'extension=mongodb.so' > /usr/local/etc/php/conf.d/30_mongodb.ini \
        && pecl install -f apcu \
        && echo 'extension=apcu.so' > /usr/local/etc/php/conf.d/30_apcu.ini \
        && chmod -R 755 /usr/local/lib/php/extensions/ \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
        && mkdir -p /app \
        && chown -R www-data:www-data /app

WORKDIR /app
