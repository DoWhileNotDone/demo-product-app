## About

This demo app will allow a user to upload a list of products, which will be processed into entities via a queue. The user will then be able to view a paginated list of products, and use searches to filter the product list.

These aspects were selected to experiment with [Sail](https://laravel.com/docs/8.x/sail), [Queue](https://laravel.com/docs/8.x/queues), and [Scout](https://laravel.com/docs/8.x/scout).

### Limitations

It is not full featured. 

While it uses Laravel 8 and Vue, it does not use Livewire/Tall. 

The test coverage is low. 

The models are not fully normalised, and there are no unique constraints. 

There isn't much in the way of validation, or job failure handling. 

The queue does not use batches, but sends the file path to a queue, which in turn delegates to a further queue for the item creation.

There is no flag to check that all items have been imported and indexed.

Pagination will scroll of screen if there are too many pages.

Handling of the search could be improved.

There is no list sorting.

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
./vendor/bin/sail artisan migrate:fresh
```

### Running Locally ###
 
1. Start the docker containers, using sail
```
./vendor/bin/sail up -d
```

2. Run the queue
```
./vendor/bin/sail artisan queue:work
```

3. View the db via cli
```
docker compose exec mysql mysql -u sail -ppassword demo_product_app
```
**Note**: Will run until process is stopped

3. Access the site: http://localhost/

4. Stop the docker containers, using sail
```
./vendor/bin/sail down
```

## Time Spent

Friday 23rd July: 1.5 hours

Getting a baseline installation using sail in place, with vue and tailwind

Issues:

https://github.com/webpack-contrib/css-loader/issues/1347#issuecomment-883715208

Resolution:
```
./vendor/bin/sail npm install --save-dev css-loader@5
```

----

Sat 24th July: 1.5 hours

Create Product model, and create Job to import Products.

Include Controller to import products from csv and dispatch to the queue.

Issues:

Understanding the queuing system and finding a suitable example to start from.

----

Sat 24th July: 1 hour

Add vue file uploader, post file to api for import.
Add vue data list component to retrieve products and display name

Sat 24th July: 0.75 hour

Add Laravel Scout - Set up to index products
Use indexed products in get 'all products'

Sat 24th July: 1 hour

Add Laravel Vue Pagination with basic tailwind styling to emulate bootstrap

Issues:

https://www.npmjs.com/package/laravel-vue-pagination Has not been updated in a while

Sat 24th July: 0.25 hour

Add Search Component to Data Items

