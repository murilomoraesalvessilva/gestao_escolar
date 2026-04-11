FROM php:8.2-apache

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    zip \
    unzip \
  && docker-php-ext-install pdo pdo_mysql zip gd

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Define a pasta pública como raiz
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
  && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html