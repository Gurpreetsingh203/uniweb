# Uniweb


## Installation

Clone the repository
```bash
$ git clone https://github.com/jonathan-uniwebs/uniwebs.git
```
Once installed, Switch to the repo folder

```bash
cd uniwebs
```
Install all the dependencies using composer
```bash
composer install
```
Copy the example env file and make the required configuration changes in the .env file
```bash
cp .env.example .env
```
Generate a new application key
```bash
php artisan key:generate
```
Run the database migrations (**Set the database connection in .env before migrating**)
```bash
php artisan migrate
```

 