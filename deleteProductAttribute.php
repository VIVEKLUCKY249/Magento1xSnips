<?php
ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);
require_once './app/Mage.php';
umask(0);
Mage::app();

$attrCPattern = $_REQUEST['attrCPattern']; //attribute code to remove
$setup = Mage::getResourceModel('catalog/setup', 'core_setup');

if(!isset($_REQUEST['no_pattern'])):
	$attrCodes = null;
	$productAttrs = Mage::getResourceModel('catalog/product_attribute_collection');
	/** @var Mage_Catalog_Model_Resource_Eav_Attribute $productAttr */
	foreach ($productAttrs as $key => $productAttr) {
		$allCodes[] = $productAttr->getAttributeCode();
		$attrCode = $productAttr->getAttributeCode();
		if(likeMatch($attrCPattern, $attrCode))
			$attrCodes[] = $attrCode;
	}
	reset($attrCodes);
	$key = key($attrCodes);
	unset($attrCodes[$key]);
else:
	$attrCode = $_REQUEST['attrCode'];
	$attrCodes = array($attrCode);
endif;

## echo "<pre/>";print_r($allCodes);die;
## echo "<pre/>";print_r($attrCodes);die;

foreach($attrCodes as $attrCode):
	try {
		$setup->startSetup();
		$setup->removeAttribute('catalog_product', $attrCode);
		$setup->endSetup();
		echo $attrCode . " attribute is removed<br />";
	} catch (Mage_Core_Exception $e) {
		print_r($e->getMessage());
	}
endforeach;

function likeMatch($pattern, $subject)
{
	$pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
	return (bool) preg_match("/^{$pattern}.*$/i", $subject);
}

## http://192.168.0.160/226/mag/cookpack/deleteProductAttribute.php?no_pattern=1&attrCode=
## http://192.168.0.160/226/mag/cookpack/deleteProductAttribute.php?attrCPattern=recipes_video
