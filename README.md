# Subscript

![Tests](https://github.com/mirrorrdotcom/subscript/workflows/Tests/badge.svg)

Subscript is the service that handles subscription management and billing for Mirrorr.

# Installation Guide

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

## Prerequisites

Below is a list of the required packages and libraries that need to be installed in order to run the project.

### The Basics

- PHP 7.4 ([PHP Docs](https://www.php.net/docs.php))
- Composer ([Composer Docs](https://getcomposer.org/))
- NodeJS v11.9.0 ([NodeJS Docs](https://nodejs.org/en/docs/))
- NPM v6.13.1 ([NPM Docs](https://docs.npmjs.com/))

Check out [NVM (Node Version Manager)](https://github.com/nvm-sh/nvm#installing-and-updating) for an easier NodeJS and NPM installation.

### Web Server

Since this is a Laravel project, you will need a running dev environment such as Homestead or Valet. As for deployment, it is best to install [Nginx](https://nginx.org/en/docs/) and configure it manually.

### Data Storage

All data in this project is stored in a MySQL database. [Click here](https://dev.mysql.com/doc/) to view the MySQL docs.

### Other

You will also need all the required PHP 7.4 packages to run Laravel and some basic tools and libraries such as `zip`, `unzip`, `git`, etc...

## Installation

### Cloning the Repository

After setting up your machine, clone the project onto it.

```bash
git clone <repository_url> subscript
```

### Installing the Dependencies

Next, go to the project's root directory and install the dependencies using Composer and NPM.

```bash
cd subscript
composer install
npm install
```

### Configuring the Environment Variables

Now that the dependencies are installed, create a fresh copy of the `.env` file which will hold all your variables.

```bash
cp .env.example .env
```

Configure the newly created `.env` file, and make sure to go through all the keys.

Next, create a new `APP_KEY` by running the following artisan command.

```bash
php artisan key:generate
```

### Creating the Database

Create a new database and configure your database connection in the `.env` file.
The `--seed` option runs the seeder which generates basic data such as currencies.  

```bash
php artisan migrate --seed
```

### Running the Tests

You can run the unit tests and feature tests with the command below.

```bash
php artisan test
```

## Deployment

In order to deploy the project on a server, start with a regular installation as mentioned above.

### Compiling the Assets

Next, compile and minify assets by running the following command.

```bash
npm run prod
```

### A Note on Permissions

You might need to grant the appropriate permissions for the `storage` and the `bootstrap` directories.

```bash
chmod -R o+w storage bootstrap
```

## Built With

- Laravel 7 ([Laravel Docs](https://laravel.com/docs/7.x/))

💙
