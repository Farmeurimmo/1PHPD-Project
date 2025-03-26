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

* **VOD** (id, title, image, shot_plot, long_plot, id_director, price, release_date, category)

* **VOD_Category** (id, id_vod, id_category)

* **Director** (id, first_name, last_name, films)

* **Actor** (id, first_name, last_name, films)

* **Actor_film** (id, id_actor, id_film)

* **Category** (id, name)

* **Users** (id, username, password(hashed), email, films_purchased)

* **Film_purchased** (id, id_user, id_film)

* **Session/Token** (id, id_user, token, expiration_date) (For authentication)
