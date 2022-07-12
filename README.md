# Result of EonX PHP Developer Test Task:

## Install

* `docker-compose build --pull --no-cache`
* `docker-compose up -d`

## Fresh Fixtures

* `docker-compose exec php composer run-script fresh-db`

## Run Tests

* `docker-compose exec php composer run-script test`

