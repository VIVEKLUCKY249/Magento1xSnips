<?php
require_once 'app/Mage.php';
Varien_Profiler::enable();
Mage::setIsDeveloperMode(true);
error_reporting(E_ALL);
ini_set('display_errors', 1);
umask(0);
Mage::app();

$totalProds = $_REQUEST['totalprods'];
$skuPrefix = $_REQUEST['skuprefix'];
$namePrefix = $_REQUEST['nameprefix'];

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

try {
	for($i = 1; $i <= $totalProds; $i++):
		$product = Mage::getModel('catalog/product');
		$prodSku = $skuPrefix."-".$i;
		$prodName = $namePrefix." ".$i;
		$product
			//->setStoreId(1) //you can set data in store scope
			->setWebsiteIds(array(1)) //website ID the product is assigned to, as an array
			->setAttributeSetId(4) //ID of a attribute set named 'default'
			->setTypeId('simple') //product type
			->setCreatedAt(strtotime('now')) //product creation time
			->setSku($prodSku) //SKU
			->setName($prodName) //product name
			->setWeight(2.0000)
			->setStatus(1) //product status (1 - enabled, 2 - disabled)
			->setTaxClassId(4) //tax class (0 - none, 1 - default, 2 - taxable, 4 - shipping)
			->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH) //catalog and search visibility
			->setManufacturer(28) //manufacturer id
			->setColor(24)
			->setNewsFromDate('06/26/2016') //product set as new from
			->setNewsToDate('06/30/2017') //product set as new to
			->setCountryOfManufacture('IN') //country of manufacture (2-letter country code)
			->setPrice(150.00) //price in form 150.00
			->setCost(175.00) //price in form 175.00
			->setSpecialPrice(130.00) //special price in form 130.00
			->setSpecialFromDate('06/1/2017') //special price from (MM-DD-YYYY)
			->setSpecialToDate('06/30/2017') //special price to (MM-DD-YYYY)
			->setMsrpEnabled(1) //enable MAP
			->setMsrpDisplayActualPriceType(1) //display actual price (1 - on gesture, 2 - in cart, 3 - before order confirmation, 4 - use config)
			->setMsrp(130.00) //Manufacturer's Suggested Retail Price
			->setMetaTitle('test meta title 2')
			->setMetaKeyword('test meta keyword 2')
			->setMetaDescription('test meta description 2')
			->setDescription('This is a long description')
			->setShortDescription('This is a short description')
			->setMediaGallery (array('images'=>array (), 'values'=>array ())) //media gallery initialization
			->addImageToMediaGallery('media/catalog/product/9/4/949504_14.jpg', array('image','thumbnail','small_image'), false, false) //assigning image, thumb and small image to media gallery
			->setStockData(
					array(
						'use_config_manage_stock' => 0, //'Use config settings' checkbox
						'manage_stock' => 1, //manage stock
						'min_sale_qty' => 1, //Minimum Qty Allowed in Shopping Cart
						'max_sale_qty' => 2, //Maximum Qty Allowed in Shopping Cart
						'is_in_stock' => 1, //Stock Availability
						'qty' => 1000 //qty
					)
			)
			->setCategoryIds(array(3,4)); //assign product to categories
		$product->save();
		$product = NULL;
		#$product->getResource()->save($product);
		echo "Product \"$prodName\" is created successfully <br/>";
	endfor;
} catch(Exception $e) {
	echo "Product creation failed because ".$e->getMessage();
	Mage::log($e->getMessage());
}
