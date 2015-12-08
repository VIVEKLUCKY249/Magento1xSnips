bin/magento cache:flush;
bin/magento cache:clean;
bin/magento indexer:reindex;
bin/magento setup:upgrade;
rm -rf var/di
bin/magento setup:di:compile;
sudo chmod -R 777 .;
