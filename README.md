# 1PHPD Project

## Requirements

- PHP 8.4
- Apache web server
- MySQL or MariaDB server

## Installation

### Import the .sql file

On your phpMyAdmin, in the desired database, import the `1PHPD.sql` file located in the `sql` directory.

### Configuration

Create a `DatabaseConfig.php` file in `config` directory with the following content (please replace the values with your
own):

```php
<?php
const DB_HOST = 'host';
const DB_USERNAME = 'username';
const DB_PASSWORD = 'password';
const DB_DATABASE = 'database';
const DB_PORT = '3306';
```
The user should have all privileges on the database to prevent any issues.

## Database

* **vods** (id, title, image, short_plot, long_plot, director_id, price, release_date)

* **vod_categories** (id, vod_id, category_id)

* **directors** (id, first_name, last_name)

* **actors** (id, first_name, last_name)

* **actor_films** (id, actor_id, vod_id)

* **categories** (id, name)

* **users** (id, username, password_hashed, email, role, created_at, updated_at)

* **films_purchased** (id, user_id, vod_id, purchase_date)

* **sessions** (id, user_id, token, expiration_date)