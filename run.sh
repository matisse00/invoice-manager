#!/bin/bash

maxcounter=45
counter=1
while ! mysql -h db -P 3306 -u"root" -p"strong" -e "show databases;" > /dev/null 2>&1; do
    sleep 1
    counter=`expr $counter + 1`
    echo "Waiting for DB"
    if [ $counter -gt $maxcounter ]; then
        >&2 echo "We have been waiting for MySQL too long already; failing."
        exit 1
    fi;
done
echo "Mysql started"
cd /var/www
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8181

