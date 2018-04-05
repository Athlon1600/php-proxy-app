FROM php:apache

RUN apt-get update
RUN apt-get install -y zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
WORKDIR /var/www/html
RUN composer create-project athlon1600/php-proxy-app:dev-master /var/www/html
RUN service apache2 start
