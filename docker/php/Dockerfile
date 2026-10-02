# 1. On définit l'image de base (le système d'exploitation de départ avec PHP déjà installé)
FROM php:8.4-fpm-alpine

COPY conf.d/custome.ini /usr/local/etc/php/conf.d

# 2. RUN permet d'exécuter des commandes Linux à l'intérieur du conteneur pendant sa construction
# apk est le gestionnaire de paquets d'Alpine (équivalent de apt sur Debian/Ubuntu)
# --no-cache permet de ne pas stocker les fichiers d'installation inutiles pour garder l'image légère
RUN apk add --no-cache \
    curl \
    git \
    wget \
    bash \
    icu-dev \
    libzip-dev \
    zlib-dev \
    g++ \
    make \
    autoconf \
    libpq-dev

# 3. ADD télécharge un fichier depuis une URL et l'ajoute dans le conteneur
# Ici, on récupère un script génial qui simplifie l'installation des extensions PHP
RUN curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o /usr/local/bin/install-php-extensions

# 4. On donne le droit d'exécution au script qu'on vient de télécharger
RUN chmod +x /usr/local/bin/install-php-extensions

# 5. On utilise le script pour installer les extensions PHP dont Symfony a besoin
# opcache (performance), intl (langues/formats), zip (fichiers compressés)
# pdo_pgsql et pgsql sont OBLIGATOIRES pour parler à ta base de données PostgreSQL
RUN install-php-extensions \
    opcache \
    intl \
    zip \
    pdo_pgsql \
    pgsql \
    gd \
    redis \
    bcmath

# 6. On installe Composer (le gestionnaire de paquets PHP) directement dans le conteneur
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# 7. WORKDIR définit le dossier par défaut où on arrive quand on entre dans le conteneur
# C'est ici que ton code Symfony sera stocké
WORKDIR /var/www
