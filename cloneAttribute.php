<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once './app/Mage.php';
umask(0);
Mage::app();

$setupModel = new Mage_Eav_Model_Entity_Setup();
$eavModel = Mage::getModel('eav/entity_setup','core_setup');

$attributeSetsIds = $eavModel->getAllAttributeSetIds('catalog_product');
/*foreach ($attributeSetsIds as $setId) {
  $groupId = $eavModel->getAttributeGroup('catalog_product', $setId, $_REQUEST['grpName']);
  echo "<pre/>";print_r($groupId);die;
  ## $setId = $_REQUEST['attrSetId'];
  ## $groupId = $_REQUEST['attrGrpId'];
  ## $eavModel->addAttributeToSet('catalog_product', $setId, $groupId['attribute_group_id'], $attributeId);
  ##$eavModel->addAttributeToGroup($entityTypeId, $setId, 30, $attributeId, null);
}*/

$attributeIdToClone = $_REQUEST['attrIdToClone'];
$attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeIdToClone);
if ($attribute->getId()) {
	$attribute->setAttributeCode($_REQUEST['attrCode']);
	$attribute->setId(null);
	$attribute->save();
}
$attributeId = $eavModel->getAttributeId('catalog_product', $_REQUEST['attrCode']);
$entityTypeId = $eavModel->getEntityTypeId('catalog_product');

foreach ($attributeSetsIds as $setId) {
  $groupId = $eavModel->getAttributeGroup('catalog_product', $setId, $_REQUEST['grpName']);
  ## echo "<pre/>";print_r($groupId);die;
  ## $setId = $_REQUEST['attrSetId'];
  ## $groupId = $_REQUEST['attrGrpId'];
  $eavModel->addAttributeToSet('catalog_product', $setId, $groupId['attribute_group_id'], $attributeId);
  ##$eavModel->addAttributeToGroup($entityTypeId, $setId, 30, $attributeId, null);
}

$eavAttrModel = Mage::getModel('catalog/resource_eav_attribute');
$setModel = Mage::getModel('eav/entity_attribute_set');
$groupModel = Mage::getModel('eav/entity_attribute_group');
/*$groupModel->setAttributeGroupName('Recipes Thai Video')
					->setAttributeSetId(4)
					->setSortOrder(100);
$groupModel->save();*/

## Run below URL:
## http://192.168.0.160/226/mag/cookpack/cloneAttribute.php?attrIdToClone=269&attrCode=recipe_tagalog_video1&attrLabel=Thai%20Video1&attrSetId=4&grpName=Recipes%20Tagalog%20Video1
