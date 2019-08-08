FROM php:7.2-apache

ENV APACHE_RUN_USER daemon
ENV APACHE_RUN_USER www-data

ADD .docker/apache/default.conf /etc/apache2/sites-available/000-default.conf
COPY . /app

WORKDIR /app

RUN chown -R www-data:www-data /app

EXPOSE 80