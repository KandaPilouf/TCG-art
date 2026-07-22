FROM php:8.2-apache
RUN docker-php-ext-install pdo_mysql && a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
COPY . /var/www/html/
# ponytail: dev-simple — app is bind-mounted in compose, so live edits show without rebuild
