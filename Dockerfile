# Utiliser PHP 8.2 + Alpine 3.18
FROM php:8.2-fpm-alpine3.18

# Installer des outils nécessaires + oniguruma-dev (pour mbstring)
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    g++ \
    nodejs \
    npm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip

# Installer l'extension GD si nécessaire
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Installer les dépendances NPM et compiler les assets (si tu utilises Vite)
RUN if [ -f package.json ]; then npm install; fi
RUN if [ -f package.json ]; then npm run build; fi

# Générer APP_KEY si besoin
RUN cp .env.example .env || true
RUN php artisan key:generate --force || true
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true

# Démarrer l'application Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]