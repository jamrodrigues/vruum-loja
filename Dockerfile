FROM php:8.2-apache

# Dependências de sistema pras extensões PHP que o PrestaShop precisa
RUN apt-get update && apt-get install -y \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        libonig-dev \
        unzip \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        intl \
        mbstring \
        pdo_mysql \
        zip \
        opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# .htaccess do PrestaShop precisa de AllowOverride All
# SetEnvIf confia no X-Forwarded-Proto do Traefik (proxy reverso termina o SSL antes do Apache)
RUN { \
        echo '<Directory /var/www/html/>'; \
        echo '    AllowOverride All'; \
        echo '    Require all granted'; \
        echo '</Directory>'; \
        echo '<IfModule mod_setenvif.c>'; \
        echo '    SetEnvIf X-Forwarded-Proto https HTTPS=on'; \
        echo '</IfModule>'; \
    } > /etc/apache2/conf-available/prestashop.conf \
    && a2enconf prestashop

WORKDIR /var/www/html
COPY . .

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Pastas que o PrestaShop precisa escrever em runtime
RUN mkdir -p var/cache var/logs var/sessions img download upload themes/classic/assets/cache \
    && chown -R www-data:www-data var img download upload app/config modules themes/classic/assets

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
