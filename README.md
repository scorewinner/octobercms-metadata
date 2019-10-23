# Installing October

Instructions on how to install a clean October instance can be found at the [installation guide](https://octobercms.com/docs/setup/installation).

# Set up this project

## Requirements

Metadata is a octobercms project that depends on

- php 7.2
- mysql 5.6
- Composer
- a webserver (apache, nginx)
  - I am using [Laravel Valet](https://laravel.com/docs/5.7/valet) on my system


### First, clone this Git repository

```
git clone git@github.com:scorewinner/octobercms-metadata.git
```

### change into the project root

```
cd metadata
```

### install the composer dependencies

```
composer install
```
### create a database
this step may vary depending on your setup. assuming a local mysql installation you can run this command:

```sql
mysql -u root -e "CREATE DATABASE IF NOT EXISTS metadata;"
```

### create an environment file by copying the template

```
cp env_example .env
```
Edit your MySQL credentials in the .env file

### migrate the database

```
php artisan october:up
```

### backend
To go to the backend, visit

```
[domain.name]/backend
```

and login with de default credentials
```
username: admin
password: admin
```

### Display metadata in Frontend
to see images and their metadata on the website, we use twig.
use this markup to see an example in the frontend

```html
<img src="{{ '[directory/file.name]'|media }}" 
title="{{ '[directory/file.name]'|metadata.title }}" 
alt="{{ '[directory/file.name]'|metadata.alt }}">
```
