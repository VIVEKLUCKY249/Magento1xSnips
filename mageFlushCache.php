<?php
echo "Start Cleaning all caches ... <br/><br/>";
ini_set("display_errors", 1);
require 'app/Mage.php';
Mage::app('admin')->setUseSessionInUrl(false);
Mage::getConfig()->init();
$types = Mage::app()->getCacheInstance()->getTypes();
try {
	echo "Cleaning data cache... <br/>";
	flush();
	foreach ($types as $type => $data) {
		echo "Removing $type ... ";
		echo Mage::app()->getCacheInstance()->clean($data["tags"]) ? "[OK]" : "[ERROR]";
		echo "<br/>";
	}
}
catch (exception $e) {
	die("[ERROR:" . $e->getMessage() . "]");
}
echo "<br/>";
try {
	echo "Cleaning stored cache... ";
	flush();
	echo Mage::app()->getCacheInstance()->clean() ? "[OK]" : "[ERROR]";
	echo "<br/><br/>";
}
catch (exception $e) {
	die("[ERROR:" . $e->getMessage() . "]");
}
try {
	echo "Cleaning merged JS/CSS...";
	flush();
	Mage::getModel('core/design_package')->cleanMergedJsCss();
	Mage::dispatchEvent('clean_media_cache_after');
	echo "[OK]<br/><br/>";
}
catch (Exception $e) {
	die("[ERROR:" . $e->getMessage() . "]");
}
try {
	echo "Cleaning image cache... ";
	flush();
	echo Mage::getModel('catalog/product_image')->clearCache();
	echo "[OK]<br/>";
}
catch (exception $e) {
	die("[ERROR:" . $e->getMessage() . "]");
}
try {
	Mage::app()->cleanCache();
	Mage::app()->getCacheInstance()->flush();
	echo "Cache storage flushed successfully!!!<br/>";
} catch (exception $e) {
	die("[ERROR:" . $e->getMessage() . "]");
}
?>
