Pong Framework v1.0.0 Support Run On Xampp

# set router หาก run on docker

a2enmod rewrite
service apache2 restart

# for docker

RewriteEngine on
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.\*)$ /index.php [NC,L,QSA]

# for xampp

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.\*)$ index.php [QSA,L]

library & Framework
Bootstrap v5.2.2
fontawesome 5.15.4
jQuery v3.6.0
sweetalert2 v11.4.0
date_thai
DataTables 1.3.4

Theme Adminlte
AdminLTE v3.2.0

# list update features

<!-- docker run -->
<!-- rest api with curl--> ✅
<!-- rest upload file --> ✅
<!-- rest delete file -->
<!-- env mangement -->
<!-- middleware api http with jwt -->
<!-- migrate data models-->
<!-- handle route controlers-->
<!-- core -->
<!-- file management -->
<!-- ci/cd -->
<!-- new threme with admin connect-->
<!-- docker backup data -->
<!-- document -->
