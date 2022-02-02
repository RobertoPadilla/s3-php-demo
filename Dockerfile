FROM php:8.1-apache

# Init server config
RUN apt update &&\
  apt-get install vim -y

# Installing dependencies for codeigniter 4
RUN apt install unzip &&\
  apt-get install libicu-dev -y &&\
  docker-php-ext-configure intl -q &&\
  docker-php-ext-install intl

#COPY app/ /var/www/s3-php
#RUN chown -R www-data:www-data /var/www/s3-php

# Changing DocumentRoot
WORKDIR /var/www/s3-php
COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN apachectl restart


COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
