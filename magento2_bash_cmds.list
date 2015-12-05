Magento 2 specific commands for Ubuntu

Composer Related commands:
https://getcomposer.org/download/
composer install
composer update
or by PHP
curl -sS https://getcomposer.org/installer | php
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin -> For installing into "bin" dir
curl -sS https://getcomposer.org/installer | php -- --filename=<filename> -> For downloading as file with custom name <filename>
php -r "readfile('https://getcomposer.org/installer');" | php
php composer.phar install
php composer.phar update
composer.phar self-update

Define custom environment variable:
export MAGE2BIN=/var/www/html/magento-2/bin
echo $MAGE2BIN

Get the rest of the libraries from last step:
php bin/magento setup:static-content:deploy

Enable/disable module from command-line:
php -f index.php -- module-disable --modules=Vendor_Module - Disable
php -f index.php -- module-enable --modules=Vendor_Module - Enable
php -f index.php -- update

magento module:enable [-c|--clear-static-content] [-f|--force] [--all] <module-list>
magento module:disable [-c|--clear-static-content] [-f|--force] [--all] <module-list>
magento module:disable Perception_Hellow
magento module:enable Perception_Hellow

php -f bin/magento module:enable --clear-static-content Vendor_Module
php -f bin/magento module:disable --clear-static-content Vendor_Module

php -f bin/magento module:enable --clear-static-content Perception_Hellow
php -f bin/magento setup:upgrade
php -f bin/magento setup:di:compile

php -f bin/magento module:disable --clear-static-content Company1_Module1


bin/magento module:enable --clear-static-content Perception_Hellow
bin/magento module:disable --clear-static-content Company1_Module1
bin/magento setup:upgrade
bin/magento setup:di:compile

SELECT * FROM `magento_database`.`setup_module` WHERE `module` = "Vendor_Module";
SELECT * FROM `magento2`.`setup_module` WHERE `module` = "Company1_Module1";

DELETE FROM `magento_database`.`setup_module` WHERE `module` = "Vendor_Module";
DELETE FROM `magento2`.`setup_module` WHERE `module` = "Company1_Module1";

Get modules list of current installed modules:
php -f index.php -- help module-list

Clear both "var/generation" and "var/di" directories during module development and troubleshooting

Clear cache the right way, by default it clears all caches
sudo php bin/magento cache:clean
php -f bin/magento cache:flush
php -f bin/magento cache:flush layout #Flush Layout XML
php -f bin/magento cache:flush full_page #Flush Full Page Cache
php -f bin/magento module:uninstall Vendor_Module
php -f bin/magento module:uninstall Company1_Module1

Find file in system by name or extension
By Extension
sudo find / -name "*.<extension>"
By Name
sudo find / -name "<filename>"

Restart services Apache2 and MySQL
sudo service apache2/mysql restart

Ask MySQL where it searches for config file
/usr/sbin/mysqld --help --verbose

bin/magento cache:flush
bin/magento cache:clean

bin/magento indexer:info
bin/magento indexer:status
bin/magento indexer:reindex

php -f bin/magento indexer:info
php -f bin/magento indexer:status
php -f bin/magento indexer:reindex

php bin/magento indexer:info
php bin/magento indexer:status
php bin/magento indexer:reindex

Note: Run command with "sudo " prefix if command displays "Could not open..." like permission related errors

find . -type f -exec grep -n -H -A 2 -T "eventManager->dispatch(" {} \; | tee ~/MAGE2EVENTS.txt
find . -type f -exec grep -n -H -A 2 -T "eventManager->dispatch(" {} \\; | tee ~/MAGE2EVENTS.txt
find . -type f -exec grep -n -H -A 2 -T "eventManager->dispatch(" {} \; > MAGE2EVENTS.log
find . -type f -exec grep -n -H -A 2 -T "eventManager->dispatch(" {} \; >> MAGE2EVENTS.log
