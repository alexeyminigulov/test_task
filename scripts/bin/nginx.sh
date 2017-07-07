#!/bin/bash

echo "==============START SETTING INGINX============"

if [ -d /var/www/site.ru ]
then
        echo "-----------Site exists-------------"
        rm -rf /var/www/site.ru
        cp -a  /root/site.ru/ /var/www/
else
        echo "-----------Nothing-----------------"
        cp -a  /root/site.ru/ /var/www/
fi

chown -R www-data:www-data /var/www/site.ru

# setting config of site
cp -R -f /root/scripts/configs/nginx/nginx.conf /etc/nginx/
cp -R -f /root/scripts/configs/nginx/default /etc/nginx/sites-available/

echo "=============END SETTING INGINX=============="
