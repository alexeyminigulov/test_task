#!/bin/bash
# main script

cd /root/scripts/
chmod +x -R ./bin

echo "====================START MAIN SCRIPT================="
apt-get update
apt-get install -y aptitude apt-utils
echo "-------------------Installed aptitude-----------------"
#aptitude -y safe-upgrade
#echo "---------------------End Updaraded--------------------"
apt-get -y install curl \
                nginx \
		debconf-utils \
                expect \
                git \
                php7.0 \
                php7.0-mbstring \
                php7.0-mcrypt \
                php7.0-gd \
                php-dom \
                php-zip \
                php-pear \
                php7.0-dev \
		php7.0-mysql \
                openssl \
                pkg-config \
                libssl-dev

phpenmod mcrypt


# include mysql.sh and mysql_secure.sh
bash ./bin/mysql.sh
bash ./bin/mysql_secure.sh
bash ./bin/mysql_createdb.sh


# install composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# change php.ini
cp -R -f /root/scripts/configs/php/php.ini /etc/php/7.0/fpm/


# install nodejs
curl -sL https://deb.nodesource.com/setup_6.x -o nodesource_setup.sh
bash /root/scripts/nodesource_setup.sh
apt-get install nodejs -y


# include setting nginx
bash ./bin/nginx.sh


echo "-------Start & restart services------"
service php7.0-fpm restart
service nginx restart


echo "==================FINISH MAIN SCRIPT=================="
