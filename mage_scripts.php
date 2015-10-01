<?php
## Create new attribute "select" with labels
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once './app/Mage.php';
umask(0);
Mage::app();

$resSetup = new Mage_Catalog_Model_Resource_Setup();

$attrCode = $_REQUEST['attrCode'];
$attrLabel = $_REQUEST['attrLabel'];

$attr = array (
  'attribute_model' => NULL,
  'backend' => '',
  'type' => 'int',
  'table' => '',
  'frontend' => '',
  'input' => 'select',
  'label' => $attrLabel,
  'frontend_class' => '',
  'source' => '',
  'required' => '0',
  'user_defined' => '1',
  'default' => '0',
  'unique' => '0',
  'note' => '',
  'input_renderer' => NULL,
  'global' => '1',
  'visible' => '1',
  'searchable' => '1',
  'filterable' => '1',
  'comparable' => '1',
  'visible_on_front' => '1',
  'is_html_allowed_on_front' => '0',
  'is_used_for_price_rules' => '1',
  'filterable_in_search' => '1',
  'used_in_product_listing' => '0',
  'used_for_sort_by' => '0',
  'is_configurable' => '1',
  'apply_to' => '',
  'visible_in_advanced_search' => '1',
  'position' => '1',
  'wysiwyg_enabled' => '0',
  'used_for_promo_rules' => '1',
  ##'frontend_label' => array('Old Site Attribute '.(($product_type) ? $product_type : 'joint').' '.$label)
  'frontend_label' => array($attrLabel, $attrLabel),
  'option' =>
  array (
    'values' =>
    array (
      0 => 'Value1',
      1 => 'Value2',
      2 => 'Value3'
    ),
  ),
);
$resSetup->addAttribute('catalog_product', $_REQUEST['attrCode'], $attr);
exit("Attribute $attrCode created successfully!!");

## Remove attribute
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once './app/Mage.php';
umask(0);
Mage::app();

$resSetup = new Mage_Catalog_Model_Resource_Setup();

$attrCode = $_REQUEST['attrCode'];

$resSetup->removeAttribute('catalog_product', $attrCode);
exit("Attribute $attrCode removed successfully!!");

## To allow access to any resource in Admin
### Add below function in module's Adminhtml Controller file
protected function _isAllowed()
{
  return Mage::getSingleton('admin/session')->isAllowed('<resource_identifier> as specified in menu tag in config or adminhtml xml files');
}

## Assign attribute to attribute set and group.
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once './app/Mage.php';
umask(0);
Mage::app();

$attrCode = $_REQUEST['attrCode'];

$entityTypeRes = Mage::getModel('catalog/product')->getResource();
$entityTypeId = $entityTypeRes->getEntityType()->getEntityTypeId();
$entityTypeCode = $entityTypeRes->getEntityType()->getEntityTypeCode();

## Now assign attribute to desired attribute set and group.
$installer = Mage::getResourceModel('catalog/setup','default_setup');
$installer->startSetup();
/*$installer->addAttribute(
     'catalog_product',
     'no_of_channels',
     array(
         'label' => 'Attribute Label',
         'group' => 'General'
     )
);*/
$installer->endSetup();
unset($installer);

$attributeSetId = Mage::getModel('eav/entity_attribute_set')
					->getCollection()
					->setEntityTypeFilter(10)
					->addFieldToFilter('attribute_set_name', "<attribute_set_name>")
					->getFirstItem()
					->getAttributeSetId();
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeRes = Mage::getModel('catalog/product')->getResource();
$entityTypeId = $entityTypeRes->getEntityType()->getEntityTypeId();
$entityTypeCode = $entityTypeRes->getEntityType()->getEntityTypeCode();

$installer->startSetup();
$installer->addAttributeToSet($entityTypeCode, $attributeSetId, '<attribute_group_name>', $attrCode, 10);
echo $attributeSetId;exit;
