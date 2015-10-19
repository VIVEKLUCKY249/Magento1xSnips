<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once("app/Mage.php");
Mage::app('default');
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
$attrLabel = $_REQUEST['label'];
$attrCode = $_REQUEST['code'];
$attrType = $_REQUEST['type'];
$attrInput = $_REQUEST['input'];

## Only for textarea type with editor enabled

//$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer = new Mage_Catalog_Model_Resource_Setup();

try {
$installer->addAttribute('catalog_category', $attrCode, array(
	'group' => 'General Information',
	'type' => $attrType,
	'label' => $attrLabel,
	'input' => $attrInput,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	($attrType == "image")?"'backend' => 'catalog/category_attribute_backend_image',":'',
	'sort_order' => '3',
	'visible' => true,
	'required' => false,
	'user_defined' => true,
	'default' => '',
	'wysiwyg_enabled' => true,
	'visible_on_front' => true,
	'is_html_allowed_on_front' => true
));
echo "Attribute $attrCode created successfully";
} catch(Exception $e) {
	echo "Error in creating attribute: $e";
}

?>
