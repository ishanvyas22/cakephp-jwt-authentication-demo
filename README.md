# CakePHP JWT Authentication Demo

This project is proof of concept on implementation of JWT authentication in CakePHP using [Authentication plugin](https://book.cakephp.org/authentication/2/en/index.html).

## Installation

1. Download the repo locally:
    ```sh
    git clone git@github.com:ishanvyas22/cakephp-jwt-authentication-demo.git
    cd cakephp-jwt-authentication-demo
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

That's all!

## Usage

#### Generate JWT token

You can send a `POST` request to `/api/users/login.json` URL with below details:

- **Username:** john
- **Password:** secret

It will return JWT token in json response.

#### Get User Information

To get authenticated user's information you have to make a `GET` request to `/api/users.json` URL with the token you got from previous step in the `Authorization` header with `Bearer` prefix.
