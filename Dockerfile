FROM php:7.3.3

RUN curl -sL https://deb.nodesource.com/setup_9.x | bash -

RUN apt-get update -y && apt-get install -y mysql-client openssl zip unzip git nodejs npm curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql mbstring
WORKDIR /var/www
COPY . /var/www

RUN chmod +x /var/www/run.sh
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install
RUN npm install
RUN npm run dev



ENTRYPOINT ["/var/www/run.sh"]
EXPOSE 8181
