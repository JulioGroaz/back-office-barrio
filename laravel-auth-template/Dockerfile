# 1) STAGE "BASE": PHP-FPM + Node + compila e installa dipendenze
FROM php:8.2-fpm AS base

ENV DEBIAN_FRONTEND=noninteractive \
    APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=1

# Installa pacchetti di sistema e PHP extensions
RUN apt-get update && \
    apt-get install -y \
        git zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
        nodejs npm \
    && docker-php-ext-install pdo_mysql zip

# Copia composer dal container ufficiale
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la cartella di lavoro
WORKDIR /var/www/html

# (Opzionale) copia il file .env se vuoi inserirlo nell'immagine
# COPY .env .env

# Copia TUTTO il progetto (composer.json, package.json, app/, public/, etc.)
COPY . .

# Installa le dipendenze Composer e NPM + build del frontend (Vite)
RUN composer install --no-dev --optimize-autoloader -vvv
RUN npm install
RUN npm run build


# 2) STAGE "RUNTIME": immagine finale con PHP-CLI
FROM php:8.2-cli AS runtime

# Imposta la cartella di lavoro
WORKDIR /var/www/html

# Copia i file elaborati (vendor, build, etc.) dallo stage base
COPY --from=base /var/www/html /var/www/html

# Espone la porta 8000
EXPOSE 8000

# Comando di avvio: Artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
