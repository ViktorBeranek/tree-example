FROM php:8.0.6-fpm-buster

RUN apt-get update -y \
    && apt-get install -y \
    git \
    zip \
