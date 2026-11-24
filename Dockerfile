ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-apache

# mysqli wajib (config CI3 pakai dbdriver mysqli), mbstring untuk helper string CI
RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev \
    && docker-php-ext-install -j"$(nproc)" mysqli mbstring \
    && rm -rf /var/lib/apt/lists/*

# .htaccess CI3 butuh mod_rewrite + AllowOverride All
RUN a2enmod rewrite \
    && sed -ri 's/^(\s*)AllowOverride None/\1AllowOverride All/' /etc/apache2/apache2.conf \
    && printf 'ServerName localhost\n' > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername

# Jangan sajikan file sensitif lewat web (hanya relevan untuk dev lokal)
RUN printf '%s\n' \
    '<FilesMatch "^\\.(env|git).*">' \
    '    Require all denied' \
    '</FilesMatch>' \
    '<Directory /var/www/html/db>' \
    '    Require all denied' \
    '</Directory>' \
    '<Directory /var/www/html/docker>' \
    '    Require all denied' \
    '</Directory>' \
    > /etc/apache2/conf-available/local-security.conf \
    && a2enconf local-security

WORKDIR /var/www/html

# Naikkan batas upload (modul/jurnal/video portofolio) tanpa mengubah php.ini host
COPY docker/php/app.ini /usr/local/etc/php/conf.d/zz-app.ini
