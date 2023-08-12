FROM php:8.0.21

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY composer*.json ./
COPY composer*.lock ./

RUN composer install

COPY . .

EXPOSE 8000

CMD ["composer", "serve:docker"]