# 1PHPD Project

## Requirements

- PHP 8.4
- Apache web server
- MySQL or MariaDB server

## Installation

Two options are available for installation:

1. If using docker or something else, bind your web server to the `1PHPD` directory and go to `localhost:8000/` in your
   browser.
2. If using XAMPP or equivalent, place the `1PHPD` directory in the `htdocs` folder and go to `localhost/1PHPD` in your
   browser.

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

```sql
CREATE TABLE users
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    username        VARCHAR(50) UNIQUE  NOT NULL,
    password_hashed VARCHAR(255)        NOT NULL,
    email           VARCHAR(255) UNIQUE NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE categories
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE actors
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL
);

CREATE TABLE directors
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL
);

CREATE TABLE vods
(
    id           INT PRIMARY KEY AUTO_INCREMENT,
    title        VARCHAR(255)   NOT NULL,
    image        VARCHAR(255),
    short_plot   TEXT,
    long_plot    TEXT,
    director_id  INT,
    price        DECIMAL(10, 2) NOT NULL,
    release_date DATE           NOT NULL,
    FOREIGN KEY (director_id) REFERENCES directors (id)
);

CREATE TABLE vod_categories
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    vod_id      INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (vod_id) REFERENCES vods (id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE,
    UNIQUE (vod_id, category_id)
);

CREATE TABLE actor_films
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    actor_id INT NOT NULL,
    vod_id   INT NOT NULL,
    FOREIGN KEY (actor_id) REFERENCES actors (id) ON DELETE CASCADE,
    FOREIGN KEY (vod_id) REFERENCES vods (id) ON DELETE CASCADE,
    UNIQUE (actor_id, vod_id)
);

CREATE TABLE films_purchased
(
    id            INT PRIMARY KEY AUTO_INCREMENT,
    user_id       INT NOT NULL,
    vod_id        INT NOT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (vod_id) REFERENCES vods (id) ON DELETE CASCADE,
    UNIQUE (user_id, vod_id)
);

CREATE TABLE sessions
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    user_id         INT                 NOT NULL,
    token           VARCHAR(255) UNIQUE NOT NULL,
    expiration_date TIMESTAMP           NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);
```

### Adding films

```sql
INSERT
IGNORE INTO categories (name) VALUES (?);
       
INSERT
IGNORE INTO actors (first_name, last_name) VALUES (?, ?);
       
INSERT
IGNORE INTO directors (first_name, last_name) VALUES (?, ?);
       
INSERT
IGNORE INTO vods (title, image, short_plot, long_plot, director_id, price, release_date)
VALUES (?, ?, ?, ?, ?, ?, ?);
       
INSERT
IGNORE INTO vod_categories (vod_id, category_id) VALUES (?, ?);
       
INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (?, ?);
```

Adding the film "The Shawshank Redemption"

```sql

INSERT
IGNORE INTO categories (name) VALUES ('Drama');
       
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Tim', 'Robbins');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Morgan', 'Freeman');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Bob', 'Gunton');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('William', 'Sadler');
       
INSERT
IGNORE INTO directors (first_name, last_name) VALUES ('Frank', 'Darabont');

INSERT
IGNORE INTO vods (title, image, short_plot, long_plot, director_id, price, release_date)
       VALUES ("The Shawshank Redemption", "/1PHPD/public/assets/vods/evades/evades.jpg",
       "Le banquier Andy Dufresne est arrêté pour avoir tué sa femme et son amant. Après une dure adaptation, il tente d'améliorer les conditions de la prison et de redonner de l'espoir à ses compagnons.",
       "LONG PLOT: Le banquier Andy Dufresne est arrêté pour avoir tué sa femme et son amant. Après une dure adaptation, il tente d'améliorer les conditions de la prison et de redonner de l'espoir à ses compagnons.",
       31,
       11.99,
       '1994-09-23');
```

Adding the film "The Godfather"

```sql
INSERT
IGNORE INTO categories (name) VALUES ('Crime');
INSERT
IGNORE INTO categories (name) VALUES ('Drama');

INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Marlon', 'Brando');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Al', 'Pacino');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('James', 'Caan');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Richard', 'S. Castellano');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Robert', 'Duvall');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Sterling', 'Hayden');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('John', ' Marley');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Richard', 'Conte');
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ('Diane', 'Keaton');

INSERT
IGNORE INTO directors (first_name, last_name) VALUES ('Francis', 'Ford Coppola');

INSERT
IGNORE INTO vods (title, image, short_plot, long_plot, director_id, price, release_date)
       VALUES ("The Godfather", "/1PHPD/public/assets/vods/godfather/godfather.jpg",
       "Le patriarche de la famille Corleone, Don Vito Corleone, est un homme respecté et craint dans le milieu du crime organisé. Son fils Michael, qui ne veut pas suivre les traces de son père, se retrouve malgré lui impliqué dans les affaires familiales.",
       "LONG PLOT: Le patriarche de la famille Corleone, Don Vito Corleone, est un homme respecté et craint dans le milieu du crime organisé. Son fils Michael, qui ne veut pas suivre les traces de son père, se retrouve malgré lui impliqué dans les affaires familiales.",
       32,
       12.99,
       '1972-03-24');
```