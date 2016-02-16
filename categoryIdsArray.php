<?php
## Test our newly overrided Category Model - app/code/local/Mage/Catalog/Model/Category.php
$magePath = 'app/Mage.php';
require_once $magePath;
Varien_Profiler::enable();
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
umask(0);
Mage::app();

$categories = Mage::getModel('catalog/category')->getCollection();
foreach($categories as $category):
	if($category->hasProducts()) $catIds[] = $category->getId();
endforeach;

echo "<pre/>";print_r($catIds);die;
