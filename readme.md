Pong Framework : Version v2.0.0
Author ปฏิพล วงศ์ศรี | Patiphon Wongsee

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

# Guide

````markdown
# Project Setup

This guide will walk you through the steps to clone the project, set up Docker, install dependencies, and configure the proxy.

## Prerequisites

- Ensure that Docker and Docker Compose are installed on your machine.
- Composer should also be installed globally.

## Getting Started

### 1. Clone the Project

Start by cloning the repository to your local machine:

```bash
git clone https://your-repo-url.git
cd your-repo-directory
```
````

### 2. Install Composer Dependencies

Install the necessary PHP dependencies using Composer:

```bash
composer install
```

### 3. Set Up Docker

Before running Docker, ensure that the following ports are not occupied by any other container or service on your machine:

- **80**
- **81**
- **443**
- **3306**
- **3307**

To bring up the Docker containers in detached mode, run:

```bash
docker-compose up -d
```

### 4. Access the Application

Once the containers are running, open your web browser and navigate to:

```plaintext
http://localhost:80
```

### 5. Initial Proxy Setup

You'll be prompted to enter the default admin credentials:

- **Email:** `admin@example.com`
- **Password:** `changeme`

### 6. Configure Proxy Hosts

After logging in, you can set up your proxy hosts. For detailed instructions on configuring proxy hosts, please refer to the official [Nginx Proxy Manager Guide](https://nginxproxymanager.com/guide/).

### 7. Domain Hosting

Ensure your domain is correctly configured to point to your local machine if you want to access it through a custom domain.

## Project Structure

- **`index.php`**: This file contains the route configuration.
- **View Files**: All view files are located inside the `web` directory.

## Migration Data

- cd models config your model and docker exec to dir models and run

```bash
php migration.php create | drop
```

## Troubleshooting

If you encounter any issues with port conflicts, ensure that the specified ports are not being used by other services or containers. You can check for running services using:

```bash
docker ps
```

Stop any conflicting containers or services before proceeding.

---

Feel free to reach out if you need further assistance!

```

This `README.md` covers the essential steps to set up the project, from cloning the repository to configuring the proxy and domain. Let me know if you need any further adjustments!
```
