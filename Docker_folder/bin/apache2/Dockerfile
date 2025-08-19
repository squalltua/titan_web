FROM php:8.3-apache

ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get -y update
RUN apt-get upgrade -y

# Install useful tools

# Install important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl4 zip libcurl4-openssl-dev

# Other PHP7 Extensions
RUN docker-php-ext-install curl
RUN apt-get -y install libsqlite3-dev libsqlite3-0
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli

RUN apt-get -y install libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

# Enable apache modules
RUN a2enmod rewrite headers
