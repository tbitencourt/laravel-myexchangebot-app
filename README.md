# PHP Challenge - My ExchangeBot - Thales Bitencourt 

This project is a chatbot application. It is able to receive specific orders from the user, 
and reply accordingly, including a user log-in and currency exchange between two currencies of any amount of money.


## Conteúdo

- [Installation](#installation)
    * [Environment](#environment)
    * [Project](#project)
- [Features](#features)
- [Conclusion](#conclusion)

## Installation

### Environment

It is a Laravel (version 8.0) application using an environment in Docker (version 19.03.13) and Docker Compose (version 1.26.0) with the following services:

* PHP 7.4.11
* Nginx 1.18
* MySQL 5.7
* Composer 1.9.1

- Note 1: A "npm" (version 10.19.1) was used to generate webpack with front-end assets, but it is outside the docker.
- Note 2: Despite using the docker, the project can be run on any Ubuntu with the above software installed and configured correctly (I have not tested it on Windows, but I believe it also works).
 
### Project

Step-by-step to configure the project:

1 . Clone "laravel-myexchangebot-app" project from GitHub:

`git clone git@github.com:tbitencourt/laravel-myexchangebot-app.git`

2 . Start docker containers:

`docker-compose up -d`

3 . Open shell from FPM container (next steps must run inside FPM container):

`docker-compose exec fpm sh`

4 . Install backend dependencies via composer:

`composer install -vvv`

3 . Create `.env` file from` .env.example`:

`php -r "file_exists('.env') || copy('.env.example', '.env');"`

6 . Generate Application key:

`php artisan key:generate`

7 . Run migrations and seeders to create the database:

`php artisan migrate --seed`

8 . Configure directory permissions:

`chmod -R 775 storage && chmod -R 775 bootstrap/cache`

9 . Exit container:

`exit`

10 . Install frontend dependencies (Laravel Mix) via npm:

`npm install && npm run dev`

11 . Set virtual host:

`echo "127.0.0.1 myexchangebot.local" | sudo tee -a /etc/hosts`

12 . Now just open the site: http://myexchangebot.local

## Features

## Conclusion

Again, thanks for opportunity and any doubt just ask me! :)

Contacts:

* [LinkedIn](https://www.linkedin.com/in/thales-bitencourt-969b7b14)

* [Github](https://github.com/tbitencourt)

* [E-mail](mailto:thalesbitencourt@gmail.com)

Thales
