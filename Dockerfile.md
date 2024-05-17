# for apache
FROM php:7.4-apache

# Copy the .htaccess file to the container
COPY .htaccess /var/www/html/.htaccess

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules and set X-Frame-Options header
RUN a2enmod rewrite headers \
    && a2enmod ssl \
    # && a2enmod socache_shmcb \ 
    && echo "Header always set X-Frame-Options 'SAMEORIGIN'" >> /etc/apache2/apache2.conf \
    && sed -i 's/AllowOverride All None/AllowOverride All /' /etc/apache2/apache2.conf \
    && chmod 644 /var/www/html/.htaccess \
    && service apache2 restart

# RUN sed -i '/SSLCertificateFile.*snakeoil\.pem/c\SSLCertificateFile \/etc\/ssl\/certs\/mycert.crt' /etc/apache2/sites-available/default-ssl.conf && sed -i '/SSLCertificateKeyFile.*snakeoil\.key/cSSLCertificateKeyFile /etc/ssl/private/mycert.key\' /etc/apache2/sites-available/default-ssl.conf
# RUN a2ensite default-ssl
# RUN service apache2 restart

COPY ./ /var/www/html/

EXPOSE 80

