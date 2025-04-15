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

- **vods** (id, title, image, short_plot, long_plot, director_id, price, release_date)

- **vod_categories** (id, vod_id, category_id)

- **directors** (id, first_name, last_name)

- **actors** (id, first_name, last_name)

- **actor_films** (id, actor_id, vod_id)

- **categories** (id, name)

- **users** (id, username, password_hashed, email, role, created_at, updated_at)

- **films_purchased** (id, user_id, vod_id, purchase_date)

- **sessions** (id, user_id, token, expiration_date)

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
    last_name  VARCHAR(100) NOT NULL ADD UNIQUE (first_name, last_name);
);

CREATE TABLE directors
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL ADD UNIQUE (first_name, last_name);
);

CREATE TABLE vods
(
    id           INT PRIMARY KEY AUTO_INCREMENT,
    title        VARCHAR(255)   NOT NULL,
    image        VARCHAR(512)   NOT NULL,
    trailer      VARCHAR(512)   NOT NULL,
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
SET @category1_id = (SELECT id FROM categories WHERE name = ?);

INSERT
IGNORE INTO actors (first_name, last_name) VALUES (?, ?);
SET @actor1_id = (SELECT id FROM actors WHERE first_name = ? AND last_name = ?);

INSERT
IGNORE INTO directors (first_name, last_name) VALUES (?, ?);
SET @director_id = (SELECT id FROM directors WHERE first_name = ? AND last_name = ?);

INSERT
IGNORE INTO vods (title, image, short_plot, long_plot, director_id, price, release_date)
VALUES (?, ?, ?, ?, @director_id, ?, ?);
SET @vod_id = (SELECT id FROM vods WHERE title = "The Dark Knight" AND director_id = @director_id);

INSERT
IGNORE INTO vod_categories (vod_id, category_id) VALUES (@vod_id, @category1_id);

INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (@actor1_id, @vod_id);
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
       VALUES ("The Shawshank Redemption", "https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg",
       "https://imdb-video.media-imdb.com/vi3877612057/1434659607842-pgv4ql-1616202333253.mp4?Expires=1743679714&Signature=uah7T~BcJiDQ68U3yejNfk0wI3RjetgjJWEClloaXSZ0keUHsLLOKENl1-~ceBBXoWCgbG5NWvHVFPxO7X3hpRxYKa41INVxj7nzYKuVk~Iihhpzeq-JlGko59Me-f7HcAe2tuFfCYDsg4Ne2UIX~lVM4Vblr2mV3vUcA4tBLe2gMWIICOs3bAw6n974jejIys~M~ep7TFlOeIEMHeJbL~2ydJatSxziRElDQNY-d5cMpXnDJBOr8vckqRtItYUyWVqti8jGO--wZmeXbP8~7rmx7BY0zUS90aklhd3b6JEpUewcVg5AdH4PPIOrYuQsP5slmlw~2ZAkCJ3RF65BjQ__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA",
       "A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.",
       "LONG PLOT: A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.",
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
       VALUES ("The Godfather", "https://m.media-amazon.com/images/M/MV5BNGEwYjgwOGQtYjg5ZS00Njc1LTk2ZGEtM2QwZWQ2NjdhZTE5XkEyXkFqcGc@._V1_.jpg",
       "https://imdb-video.media-imdb.com/vi1348706585/1434659607842-pgv4ql-1616202346191.mp4?Expires=1743679782&Signature=Xwskqq0t9JwS7AHBkZJ0ee3HcC~zZxUvK0mI~9EWpC3J71vVXfvXuz-hwBeejg1-UxXLDLV~g1SO9UV~0LfignCw-YQYaRTyINAhm7uqsyjU7D9arDWZIhJZYBbWVlU0b-C6A3s1accd-Ve247oLy74GaKSFEjLJWfaTpwzbAvFVmbUT5arZbzr8lNjD4GCTtGTTyqAMh36SV68UMjniV-Z1ZCVO8mdF20lUmRmfMBDHaszIT0x1PJL7JllRxdFbPP2gTNo-09peGbPhA2gdFr91gNadnnvOR8QJmii~ct4C1CgnqVhN363v3yHa5Ik0AzkFTIQDZ0ohrynV-xTdsw__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA",
       "The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.",
       "LONG PLOT: The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.",
       32,
       12.99,
       '1972-03-24');
```

Adding the film "The Dark Knight"

```sql
INSERT
IGNORE INTO categories (name) VALUES ("Crime");
SET @category1_id = (SELECT id FROM categories WHERE name = "Crime");
INSERT
IGNORE INTO categories (name) VALUES ("Drama");
SET @category2_id = (SELECT id FROM categories WHERE name = "Drama");

INSERT
IGNORE INTO actors (first_name, last_name) VALUES ("Christian", "Bale");
SET @actor1_id = (SELECT id FROM actors WHERE first_name = "Christian" AND last_name = "Bale");
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ("Heath", "Ledger");
SET @actor2_id = (SELECT id FROM actors WHERE first_name = "Heath" AND last_name = "Ledger");
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ("Aaron", "Eckhart");
SET @actor3_id = (SELECT id FROM actors WHERE first_name = "Aaron" AND last_name = "Eckhart");
INSERT
IGNORE INTO actors (first_name, last_name) VALUES ("Michael", "Caine");
SET @actor4_id = (SELECT id FROM actors WHERE first_name = "Michael" AND last_name = "Caine");

INSERT
IGNORE INTO directors (first_name, last_name) VALUES ("Christopher", "Nolan");
SET @director_id = (SELECT id FROM directors WHERE first_name = "Christopher" AND last_name = "Nolan");

INSERT
IGNORE INTO vods (title, image, short_plot, long_plot, director_id, price, release_date)
VALUES ("The Dark Knight", "https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UY2048_.jpg", "When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.", "LONG PLOT: When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.", @director_id, 11.99, '2008-08-13');
SET @vod_id = (SELECT id FROM vods WHERE title = "The Dark Knight");

INSERT
IGNORE INTO vod_categories (vod_id, category_id) VALUES (@vod_id, @category1_id);
INSERT
IGNORE INTO vod_categories (vod_id, category_id) VALUES (@vod_id, @category2_id);

INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (@actor1_id, @vod_id);
INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (@actor2_id, @vod_id);
INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (@actor3_id, @vod_id);
INSERT
IGNORE INTO actor_films (actor_id, vod_id) VALUES (@actor4_id, @vod_id);
```
