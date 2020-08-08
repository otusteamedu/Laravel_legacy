## Build Setup

``` bash
# create .env
cp .env.example .env

# install dependencies
composer install
npm install

# run migrations
php artisan migrate

# generate keys
php artisan key:generate
php artisan passport:keys

# build for development
npm run dev

# Run Laravel development server http://127.0.0.1:8000
php artisan serve
```
