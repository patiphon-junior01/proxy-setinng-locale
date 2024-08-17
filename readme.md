Version v1.0.0

# For restart service apache2

a2enmod rewrite
service apache2 restart

# .htaccess Setting rule

## for docker

RewriteEngine on
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.\*)$ /index.php [NC,L,QSA]

## for xampp

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.\*)$ index.php [QSA,L]

# library & Framework

- Bootstrap v5.2.2
- fontawesome 5.15.4
- jQuery v3.6.0
- sweetalert2 v11.4.0
- Date_thai
- DataTables 1.3.4

# Theme Adminlte

AdminLTE v3.2.0

# Feature

- Docker Run With Proxy Manager
- REST API with curl
- REST upload file
- REST delete file
- env Management
- API validate with jwt
- Middleware api
- Middleware page
- Handler route controlers
- Migrate data models create delete
