#!/bin/bash

cd /var/www
php artisan migrate:fresh
php artisan serve --host=0.0.0.0 --port=8181

