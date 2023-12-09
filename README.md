# Bookstore Management Application

Made for Timedoor Backend Bootcamp 2024 registration exam

## Requirements

-   PHP 8.1
-   Laravel 10
-   MySQL

## Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/farfnd/timedoor-backend-bookstore
    ```

2.  **Install Composer Dependencies:**

    ```bash
    composer install
    ```

3.  **Create a `.env` File:**

    Duplicate the `.env.example` file and rename it to `.env`.

4.  **Create a database:**

    Create a new MySQL database, and update the necessary database credential configurations in the `.env` file.

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate an Application Key:**

    ```bash
    php artisan key:generate
    ```

6.  **Run Database Migrations & Seeders:**

    ```bash
    php artisan migrate --seed
    ```

7.  **Start the Development Server:**

    ```bash
    php artisan serve
    ```

    By default, the application will be available at `http://localhost:8000`.

## Usage

-   Access the application in your web browser at `http://localhost:8000`.
-   Use the provided functionalities according to the application's features.

## Features

-   List of top books, with displayed data limit and search by book and author name functionality: `/`
-   List of top 10 authors: `/top-authors`
-   Input book rating: `/input-rating`

## Testing

1. **Run PHPUnit Tests:**

    ```bash
    php artisan test
    ```

    This command will run all the tests in the `tests` directory, and will wipe out all the data stored in the database prior to running the tests.
