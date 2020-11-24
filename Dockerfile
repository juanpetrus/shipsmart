FROM php:7.3-apache

RUN apt-get update
RUN docker-php-ext-install mysqli

RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN chmod 777 /var/www/html

WORKDIR /var/www/html

COPY . /var/www/html