Menubar sidebar ->

Provider setup
Menuserviceprovider.php
then register in config app.php

**BackUp MasterDatabse**

```sh
mysqldump -u  MASTER_LOGIN_USERNAME -p MASTER_LOGIN_DATABASE > MasterDatabase.sql
Pass: ******
```

**Scrape data from API Login Project to Master**

```sh
http://domainname.com/hit?start=12&end=100&site=http://loginprojectdomain.com&refkey=test-domain
```

**Reset Count for Next Scraping**

```sh
https://domain.com/reset?count=1000
```

**insert Fake UserNames**

```sh
https://domain.com/insert?userCount=20
```

cd Laravel command not work :

Use :

```sh
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

Or

```sh
export PATH="~/.config/composer/vendor/bin:$PATH"
```

Laravel memory limit:

```sh
COMPOSER_MEMORY_LIMIT=-1 composer update
```

Make Database Table: with this command one file in migration table will make and post model will make

```sh
php artisan make:model Post -m
php artisan key:generate
```

Cache clear :

```sh
php artisan cache:clear
php artisan config:cache
php artisan route:clear
composer dump-autoload
```

Laravel Permission commands:

```sh
sudo chmod -R o+rw bootstrap/cache
sudo chmod -R o+rw storage
```

```sh
sudo chmod -R 777 storage
sudo chmod -R 777 bootstrap/cache
```

Change Onwerchip:

```sh
sudo chown -R runcloud:runcloud /home/runcloud/webapps/blackboardedu
sudo chmod 755 -R /home/runcloud/webapps/blackboardedu
```

Change php Version Dependency

```sh
export XAMPP_HOME=/Applications/XAMPP
export PATH=${XAMPP_HOME}/bin:${PATH}
export PATH
```

Remove public add .htaccess in root dir

```sh
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.\*)$ /public/$1 [L,QSA]
```

Make Controller :

```sh
php artisan make:controller BlogController
```

Alter table in database via laravel:

Step1 :

```sh
php artisan make:migration alter_posts_add_published_at_cloumn --table=posts
```

```sh
sudo systemctl status mongodb
sudo systemctl stop mongodb
sudo systemctl start mongodb
sudo systemctl restart mongodb
```

Link php with local system

```sh
sudo ln -s /opt/lampp/bin/php /usr/bin/php

sudo apt install gcc
sudo apt-get install autoconf
sudo apt-get update && apt-get install -y libssl-dev && rm -rf /var/lib/apt/lists/\*
sudo apt-get install libssl-dev
sudo apt-get install build-essential
```

Download and Install Composer 2

```sh
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
To install composer globally, use the following command which will download and install Composer as a system-wide command named composer, under /usr/local/bin:
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
