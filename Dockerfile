FROM php:7.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

RUN mkdir -p /var/lib/php/sessions && chown -R www-data:www-data /var/lib/php/sessions

COPY docker/php.ini /usr/local/etc/php/conf.d/99-n0mcode.ini

WORKDIR /var/www/html