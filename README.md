
## About

This demo app will allow a user to upload a list of products, which will be processed into entities via a queue. The user will then be able to view a paginated list of products, and use searches to filter the product list.

It is not full featured. While it uses Laravel 8 and Vue, it does not use Livewire/Tall. The test coverage is low. The models are not fully normalised.

These aspects were selected to experiment with [Sail](https://laravel.com/docs/8.x/sail), [Queue](https://laravel.com/docs/8.x/queues), and [Scout](https://laravel.com/docs/8.x/scout).

## Time Spent

Friday 23rd July: 1.5 hours

Getting a baseline installation using sail in place, with vue and tailwind

Encountered:

https://github.com/webpack-contrib/css-loader/issues/1347#issuecomment-883715208

Resolution:
```
./vendor/bin/sail npm install --save-dev css-loader@5
```

## Installation

All instructions should be run from the root directory.

### Local Installation with Docker ###

1. Install composer package dependencies
```
docker run --rm --interactive --tty --volume $PWD:/app  composer install
```

2. Start the docker containers, to configure using sail
```
./vendor/bin/sail up -d
```

**Note**: On first run, this will pull down the initial images required 

3. Install node package dependencies
```
docker run -it --rm -v "$PWD":/app -w "/app" node:latest npm install
```

4. Configure site
```
cp .env.docker .env
```
```
./vendor/bin/sail artisan key:generate
```
```
./vendor/bin/sail npm run dev
```

5. Create Database

```
./vendor/bin/sail artisan migrate:install
```
```
./vendor/bin/sail artisan migrate
```
```
./vendor/bin/sail artisan db:seed
```

### Running Locally ###
 
1. Start the docker containers, using sail
```
./vendor/bin/sail up
```

2. Access the site: http://localhost/

3. Stop the docker containers, using sail
```
./vendor/bin/sail down
```
