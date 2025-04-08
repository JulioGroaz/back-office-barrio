FROM php:8.2-fpm AS base

ENV DEBIAN_FRONTEND=noninteractive \
    APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=1

RUN apt-get update && \
    apt-get install -y \
        git zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
        nodejs npm \
    && docker-php-ext-install pdo_mysql zip

# Copia composer dal container ufficiale
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la working dir
WORKDIR /var/www/html
#  COPY .env .
# Copia il codice Laravel (tutto il progetto)
COPY . .

# Installa dipendenze PHP + build Vite
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Secondo stage: container finale
FROM php:8.2-cli AS runtime

WORKDIR /var/www/html

# Copio il codice già "compilato" dallo stage base
COPY --from=base /var/www/html /var/www/html

# Espongo la porta 8000
EXPOSE 8000

# Avvio Laravel in maniera semplice
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


