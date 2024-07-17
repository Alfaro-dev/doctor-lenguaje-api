#!/bin/sh

cd /var/www

php artisan optimize
php artisan migrate --force
php artisan populate-apps
php artisan config:cache
php artisan route:cache
php artisan storage:link
php artisan event:cache
php artisan db:seed --force

chmod -R 0777 storage

/usr/bin/supervisord -c /etc/supervisord.conf
