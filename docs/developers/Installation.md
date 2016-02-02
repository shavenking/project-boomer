# Installation Guide

## Environment

* PHP >= 5.5.9
* MySQL 5

## Tools

* [Composer](https://getcomposer.org)

## Steps To Bootstrap APP

1. `composer install` to install dependencies.
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `php artisan migrate --seed` to create database tables.
