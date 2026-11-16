
FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libzip-dev libicu-dev unzip \
    && docker-php-ext-install pdo_mysql zip intl

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
