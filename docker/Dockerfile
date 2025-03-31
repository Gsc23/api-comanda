ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-fpm-alpine
LABEL maintainer="Seygo"

# Atualizar pacotes e instalar dependências no Alpine (substituindo apt-get por apk)
RUN apk update && apk upgrade && apk add --no-cache \
    curl-dev \
    pkgconfig \
    openssl-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    bash \
    build-base \
    autoconf \
    bison \
    re2c \
    libxml2-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql 
   
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod 777 -R /var/www/html/

CMD php artisan serve --host=0.0.0.0 --port=8000
