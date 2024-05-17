Pong Framework v1.0.0 Support Run On Xampp

# set router หาก  run on docker
a2enmod rewrite
service apache2   restart

# for docker
RewriteEngine on
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ /index.php [NC,L,QSA]


# for xampp
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php [QSA,L]



library & Framework
Bootstrap  v5.2.2
fontawesome 5.15.4

Theme Adminlte
AdminLTE v3.2.0