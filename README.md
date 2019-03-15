# Installing October

Instructions on how to install a clean October instance can be found at the [installation guide](https://octobercms.com/docs/setup/installation).

# Set up this project

## Requirements

Metadata is a octobercms project that depends on

- php 7.2 or higher
- mysql 5.6 or higher
- a webserver (apache, nginx)
  - I am using [Laravel Valet](https://laravel.com/docs/5.7/valet) on my system
- Composer 1.8.0


### First, clone this Git repository

```
git clone git@gitlab.liip.ch:tim.keller/metadata.git
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
```
mysql -u root -e "CREATE DATABASE IF NOT EXISTS metadata;"
```

### create an environment file by copying the template
```
cp env_example .env
```

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

