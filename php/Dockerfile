
FROM php:7.3-fpm-stretch

WORKDIR /var/www/symfony/

RUN apt-get update && apt-get install -y --no-install-recommends \
        nodejs \
        unzip \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libicu-dev \
        libpq-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
&& docker-php-ext-install \
        zip \
        intl \
        pdo \
        pgsql \
        pdo_pgsql \

&& curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer \
&&curl -sL https://deb.nodesource.com/setup_11.x  | bash -