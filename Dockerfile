FROM php:8.0-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
ADD ./www /var/www/html