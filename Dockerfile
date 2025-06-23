# Utiliser une image officielle PHP avec FPM et Alpine Linux
FROM php:8.1-fpm-alpine

# Installer des outils nécessaires
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier tous les fichiers du projet dans le conteneur
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Générer la clé d'application si nécessaire
RUN cp .env.example .env || true
RUN php artisan key:generate || true

# Lancer l'artisan serve (serveur Laravel simple)
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]