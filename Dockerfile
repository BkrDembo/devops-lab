FROM php:8.2-apache
RUN apt-get update \
    && apt-get upgrade -y \
    && docker-php-ext-install mysqli \
    && rm -rf /var/lib/apt/lists/*
COPY app/ /var/www/html/
EXPOSE 80
