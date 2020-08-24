# inventory reader

## Requirements
* Docker

## Installation

```shell script
# up the container
docker-compose up
# enter inside the container
docker exec -it api.products.dev sh
# create schema
php bin/console doctrine:mongodb:schema:create
# running tests
vendor/bin/phpunit
```

### Composed
* PHP 7.4.9
* MongoDB 4.4.0

### Using
* Symfony 5.1.*
* PHP Unit 9
* PHPStan analytics
