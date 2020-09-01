## Description
Educational project made on courses Otus "Framework Laravel".

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

# Set your telegram telegram bot tooken to TELEGRAM_BOT_TOKEN in .env

# Start queues
php artisan queue:listen

# Optionally generate fake data for development
php artisan db:seed
```
