# Food-Order Backend

This is the food order backend admin panel

## Installation

clone the repo

```bash
git clone https://github.com/naingaunglinn/food-order-backend.git
```

## Usage

```python
cd food-order-backend

# copy .env
cp .env.example .env

# install require dependencies
composer install

# build up docker
./vendor/bin/sail up --build

# run migration
./vendor/bin/sail artisan migrate

# register filament user
./vendor/bin/sail artisan make:filament-user
```

## Features
- Category Management
- Product Management

The above features will be include

