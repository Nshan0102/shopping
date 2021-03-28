## About Project

Welcome! We are about to build a website which says, just visit our website and do a window shopping! We are sure that everyone who visits the website cannot just visit the website without any order.

## Project Requirements
- PHP >=7.4
- COMPOSER >=2.0-dev
- LARAVEL >=8.12
- NODE >=12.18.0
- NPM >=6.14.4

## Setup instructions
- Clone this repository to your local / virtual machine
- ssh to your machine server
- go to project cloned directory
- setup copy .env.example file as .env and write your own configurations
- run: composer install
- run: npm install
- run: npm run prod
- run: php artisan key:generate
- run: php artisan config:clear
- run: php artisan migrate --seed ( test user: username: Jhon, email: jhone.doe@gmail.com, password: Jhone#Doe )