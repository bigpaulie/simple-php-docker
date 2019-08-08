FROM php:7.2-apache

COPY .docker/apache/default.conf /etc/apache2/sites-available/000-default.conf
COPY . /app

WORKDIR /app

EXPOSE 80