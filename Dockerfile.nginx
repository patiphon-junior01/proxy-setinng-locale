# nginx
FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    nginx \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-install \
    zip \
    pdo \
    pdo_mysql \
    gd


ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# COPY default.conf /etc/nginx/conf.d/default.conf
COPY ./default.conf /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-enabled/default

RUN groupadd -g 33 www-data && \
    useradd --no-log-init -u 33 -g www-data www-data

COPY php.ini /usr/local/etc/php/php.ini
# Update session.save_path in php.ini
RUN sed -i 's|;session.save_path = "/tmp"|session.save_path = "/var/www/html/tmp"|g' /usr/local/etc/php/php.ini

COPY . /var/www/html

COPY web/asset/image /var/www/html/web/asset/image
RUN chown -R www-data:www-data /var/www/html/web/asset/image

# COPY web/asset/image/image_web /var/www/html/web/asset/image
RUN chown -R www-data:www-data /var/www/html/web/asset/image/image_web

COPY tmp /var/www/html/tmp
RUN chown -R www-data:www-data /var/www/html/tmp

EXPOSE 9000

CMD service nginx start && php-fpm
