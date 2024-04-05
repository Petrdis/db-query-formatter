FROM php:8.3-cli-alpine as php-cli-base

RUN docker-php-ext-install mysqli
