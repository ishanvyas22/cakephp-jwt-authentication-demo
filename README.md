# CakePHP JWT Authentication Demo

This project is proof of concept on implementation of JWT authentication in CakePHP using [Authentication plugin](https://book.cakephp.org/authentication/2/en/index.html).

## Installation

1. Download the repo locally:
    ```sh
    git clone git@github.com:ishanvyas22/cakephp-pingcrm.git
    cd project-name
    ```

2. Install PHP dependencies:
    ```sh
    composer install
    ```

3. Read and edit the environment specific `config/app_local.php` and setup the `'Datasources'` and any other configuration relevant for your application. Other environment agnostic settings can be changed in `config/app.php`.

4. Run database migrations & seeders:
    ```sh
    bin/cake migrations migrate
    bin/cake migrations seed --seed=DatabaseSeed
    ```

5. Run the dev server (the output will give the address):
    ```sh
    bin/cake server
    ```
