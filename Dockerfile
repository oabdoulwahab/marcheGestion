# Utiliser PHP 8.2 (compatible avec tes dépendances)
FROM php:8.2-fpm-alpine

# Installer des outils nécessaires + oniguruma-dev (pour mbstring)
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    oniguruma-dev\
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    g++                      # nécessaire pour certaines extensions ou npm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip

# Installer l'extension GD
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Activer l'extension zip (facultatif si déjà installée)
RUN docker-php-ext-enable zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Installer les dépendances NPM et compiler les assets (si tu utilises Laravel Mix/Vite)
# Si tu n'utilises pas le frontend (ex: API-only), tu peux supprimer ces lignes
RUN if [ -f package.json ]; then npm install; fi
RUN if [ -f package.json ]; then npm run dev; fi

# Générer la clé d'application Laravel
RUN cp .env.example .env || true
RUN php artisan key:generate --force || true

# Démarrer l'application Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]