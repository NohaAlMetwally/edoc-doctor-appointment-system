FROM php:7.3-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

# Exposer port 80 pour Apache
EXPOSE 80

CMD ["apache2-foreground"]

