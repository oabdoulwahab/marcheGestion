# Utiliser PHP 8.2
FROM php:8.2-fpm-alpine

# Installer des outils nécessaires
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Générer la clé d'application Laravel
RUN cp .env.example .env || true
RUN php artisan key:generate || true

# Démarrer l'application Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]