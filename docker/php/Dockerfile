FROM php:7.1-cli

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zlib1g-dev && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/app/
COPY composer.* /var/www/app/
COPY app/AppKernel.php /var/www/app/app/
RUN composer install
