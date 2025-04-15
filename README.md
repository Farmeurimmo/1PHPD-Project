# 1PHPD Project

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Project Structure](#project-structure)
4. [Database](#database)

By:

- PETIT Flora
- MASSONNAT Robin

## Requirements

- PHP 8.4
- Apache web server
- MySQL or MariaDB server

## Installation

Two options are available for installation:

1. If using XAMPP or equivalent, place the `1PHPD` directory in the `htdocs` folder and go to `localhost/1PHPD` in your
   browser.
2. If using docker or something else, bind your web server to the parent dir of `1PHPD` directory and go to
   `localhost:8000/1PHPD` in your
   browser.

### Import the .sql file for the database

On your phpMyAdmin, in the desired database, import the `1phpd.sql` file located in the `sql` directory.

### Configuration (for database connection)

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

**You should be ready to go.**

---

## Project Structure

We chose the **MVC (Model-View-Controller)** architecture for this project.

### Why MVC?

After some research about the best practices for php development, we found that the MVC architecture is a good and not
too complex way to structure a PHP application.

Source:

- https://www.univ-orleans.fr/iut-orleans/informatique/intra/tuto/php/php-mvc.html (A little bit outdated but still
  relevant)
- https://dyma.fr/blog/introduction-au-mvc-avec-php/ (pretty good explanation with recent examples)

### Code architecture

The .htaccess file is used to redirect all requests to the `public/index.php` file, which is the entry point of the
application. (It also prevents direct access to critical files like the .env file, the config file, etc.)

The Router class uses the routes given in the `public/index.php` file to determine which controller and method to call
based on the URL.

#### `controllers`

Handle the app’s logic and send data to the views. (like a bridge)

Note: all controllers extend the `BaseController` class, which provides common functionality like getting a model
instance and rendering views.

#### `models`

Work with the database. They define and manage the data.

#### `views`

Display data to the user. These are HTML files with embedded PHP.

Note: There is a layout file to structure the rendered views. By default, the layout file add the header, the footer,
the CSS, JS file for the icons and the main html structure in which the view will be rendered.

Note 2: There are some reusable components that are imported in the views like `CommonSearchBarView.php` to prevent code
duplication.

#### `config`

Stores the database logins and Database class.

#### `public`

As mentioned before, this is the entry point of the application. It contains the `index.php` file that handles all
requests and routes them to the appropriate controller and method via the Router class contained in the `core` folder.

There are also the CSS and JS files for the application in the subfolder `assets`.

#### `core`

Contains the Router class that handles the routing of the application. Based on the routes defined, it will trigger
the function in the appropriate controller.

#### `sql`

SQL dump export of the database.

### Security

- **Password hashing**: Passwords are hashed with `password_hash` before being stored.
- **Session management**: User sessions use tokens generated with `bin2hex(openssl_random_pseudo_bytes(32))`, then
  hashed and stored with an expiry date.
- **Input validation (XSS)**: Inputs are sanitized with `htmlspecialchars` and `filter_var`.
- **Prepared statements**: All SQL queries use prepared statements to prevent injection.
- **Authentication**: Each user-related requests require authentication.
- **File protection**: `.htaccess` blocks access to sensitive files like `DatabaseConfig` implicitly by redirecting all
  requests to
  `public/index.php`.

### Styling

- **Responsive on mobile and desktop**
- **Use fontawesome for icons**

### Possible improvements

- **Checkout system**: Currently you don't have to pay to buy a film.
- **User roles**: Currently, all users are treated the same. We could add a role system to differentiate between
  admins and regular users. (With this we could implement comments, ratings, admin management, etc.)
- **Film recommendations**: recommendations based on the user activity and preferences.

---

## Database

The database uses 9 tables as describe below:

- **vods** (id, title, image, plot, director_id, price, release_date)

- **vod_categories** (id, vod_id, category_id)

- **directors** (id, first_name, last_name)

- **actors** (id, first_name, last_name)

- **actor_films** (id, actor_id, vod_id)

- **categories** (id, name)

- **users** (id, username, password_hashed, email, created_at, updated_at)

- **films_purchased** (id, user_id, vod_id, purchase_date)

- **sessions** (id, user_id, token, expiration_date)

### `users`

- `id`: unique identifier for each user
- `username`: users' username
- `password_hashed`: encrypted users' password
- `email`: users' email adress
- `created_at`: date and time of the account creation
- `updated_at`: date and time of the last account modification

### `categories`

- `id`: unique identifier for each category
- `name`: name of the category

### `actors`

- `id`: unique identifier for each actor
- `first_name`: actor's first name
- `last_name`: actor's last name

### `directors`

- `id`: unique identifier for each director
- `first_name`: director's first name
- `last_name`: director's last name

### `vods`

- `id`: unique identifier for each movie
- `title`: title of the movie
- `image`: link the the poster of the movie
- `plot`: plot of the movie
- `director_id`: unique identifier of the director from the `directors` table
- `price`: price of the movie
- `release_date`: release date of the movie

### `vod_categories`

- `id`: unique identifier for each movie associated with its category
- `vod_id`: unique identifier of the movie from the `vods` table
- `category_id`: unique identifier of the category from the `categories` table

### `actor_films`

- `id`: unique identifier for each actor associated with its movie
- `actor_id`: unique identifier of the actor from the `actors` table
- `vod_id`: unique identifier of the movie from the `vods` table

### `films_purchased`

- `id`: unique identifier for each purchase
- `user_id`: unique identifier of the user from the `users` table
- `vod_id`: unique identifier of the movie from the `vods` table
- `purchase_date`: date of the purchase

### `sessions`

- `id`: unique identifier for each sessions
- `user_id`: unique identifier of the user from the `users` table
- `token`: session token to stay connected
- `expiration_date`: expiration date for the token

The tables were created with the folowing SQL code:

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
    plot         TEXT           NOT NULL,
    director_id  INT            NOT NULL,
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
