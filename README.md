## Step 1
git clone https://github.com/PhyoZaw15/Coffee-Supplies-Shop.git

## Step 2
- composer install

## Step 3 ( To create Database and update to .env )

## Step 4
- php artisan key:generate
- composer dump-autoload
- php artisan migrate:fresh --seed

## Step 5
- php artisan serve

## Application running in http://localhost:8000 or http://localhost:your_port_number
