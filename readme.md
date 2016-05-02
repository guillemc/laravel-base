# Laravel Base

This is a Laravel 5.2 app used as a template or starting point for building Laravel apps.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Installation

Clone or download the repository

```bash
git clone https://github.com/guillemc/laravel-base.git myappname
```

Give write permissions over the `storage` folder to the webserver

```bash
chmod -R a+w storage
```

Create an `.env` file for the app

```bash
cp .env.example .env
```

Generate a random encryption key in the `.env` file. Then edit the rest of the file (database credentials, mail server settings, etc.)

```bash
php artisan key:generate
```

Run the database migrations

```bash
php artisan migrate
```

Create an admin user

```bash
php artisan admin:create
```