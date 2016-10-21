<?php
require_once("app/Mage.php");
umask(0);
Mage::app("default");

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
Mage::init();

// Set an Admin Session
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
Mage::getSingleton('core/session', array('name' => 'adminhtml'));
$userModel = Mage::getModel('admin/user');
$userModel->setUserId(1);
$session = Mage::getSingleton('admin/session');
$session->setUser($userModel);
$session->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());

$connection = Mage::getSingleton('core/resource')->getConnection('core_write');

/* Get orders collection of pending orders, run a query */
        $collection = Mage::getModel('sales/order')
                        ->getCollection()
                //      ->addFieldToFilter('state',Array('eq'=>Mage_Sales_Model_Order::STATE_NEW))
                        ->addAttributeToSelect('*');

/*$out = '<?xml version="1.0" encoding="windows-1250" ?>*/
$out = '<?xml version="1.0" encoding="utf-8"?>
<dat:dataPack id="order001" version="2.0" note="Import Order">';

foreach($collection as $order)
{
	if($billingAddress = $order->getBillingAddress()) {
		$billingStreet = $billingAddress->getStreet();
	}
	if ($shippingAddress = $order->getShippingAddress()){
		$shippingStreet = $shippingAddress->getStreet();
	}
    $out .= "<dat:dataPackItem version=\"2.0\">\n";
	$out.= "<ord:order>\n";
		$out.= "<ord:orderHeader>\n";
			$out.= "<ord:orderType>receivedOrder</ord:orderType>\n";
			$out.= "<ord:numberOrder>".$order->getIncrementId()."</ord:numberOrder>\n";
			$out.= "<ord:date>".date('Y-m-d',strtotime($order->getCreatedAt()))."</ord:date>\n";
			$out.= "<ord:dateFrom>".date('Y-m-d',strtotime($order->getCreatedAt()))."</ord:dateFrom>\n";
			$out.= "<ord:dateTo>".date('Y-m-d',strtotime($order->getCreatedAt()))."</ord:dateTo>\n";
			$out.= "<ord:text>Objednávka z internetového obchodu</ord:text>\n";
			$out.= "<ord:partnerIdentity>\n";
				$out.= "<typ:address>\n";
					$out.= "<typ:company>{$billingAddress->getCompany()}</typ:company>\n";
					$out.= "<typ:division></typ:division>\n";
					$out.= "<typ:name>{$billingAddress->getName()}</typ:name>\n";
					$out.= "<typ:city>{$billingAddress->getCity()}</typ:city>\n";
					$out.= "<typ:street>{$billingStreet[0]}</typ:street>\n";
					$out.= "<typ:zip>{$billingAddress->getPostcode()}</typ:zip>\n";
				$out.= "</typ:address> \n";
				$out.="<typ:shipToAddress>\n";
					$out.= "<typ:company>{$shippingAddress->getCompany()}</typ:company>\n";
					$out.= "<typ:division></typ:division>\n";
					$out.= "<typ:name>{$shippingAddress->getName()}</typ:name>\n";
					$out.= "<typ:city>{$shippingAddress->getCity()}</typ:city>\n";
					$out.= "<typ:street>{$shippingStreet[0]}</typ:street>\n";
					$out.= "<typ:zip>{$shippingAddress->getPostcode()}</typ:zip>\n";
				$out.= "</typ:shipToAddress>\n";
			$out.= "</ord:partnerIdentity>\n";
			$out.= "<ord:paymentType> \n";
				$out.= "<typ:ids>{$order->getShippingDescription()}</typ:ids>\n";
			$out.= "</ord:paymentType>\n";
			$out.= "<ord:priceLevel>\n";
				$out.= "<typ:ids></typ:ids>\n";
			$out.= "</ord:priceLevel>\n";
		$out.= "</ord:orderHeader>\n";
		$out.= "<ord:orderDetail> \n";
		foreach ($order->getAllItems() as $itemId => $item){
			// textova polozka
			$out.= "<ord:orderItem> \n";
				$itemname =  $item->getName();
	$itemname =  str_replace('&', " ", $itemname);
	$out.= "<ord:text>{$itemname}</ord:text> \n";
				$out.= "<ord:quantity>{$item->getQtyOrdered()}</ord:quantity>\n";
				//$out.= "<ord:delivered></ord:delivered>";
				$out.= "<ord:rateVAT>high</ord:rateVAT> \n";
				$out.= "<ord:homeCurrency> \n";
					$out.= "<typ:unitPrice>{$item->getPrice()}</typ:unitPrice>\n";
				$out.= "</ord:homeCurrency>\n";
				$out.= "<ord:stockItem>\n";
					$out.= "<typ:stockItem>\n";
						$out.= "<typ:ids>{$item->getSku()}</typ:ids>\n";
					$out.= "</typ:stockItem>\n";
				$out.= "</ord:stockItem>\n";
			$out.= "</ord:orderItem>\n";
		}
		$out.= "</ord:orderDetail>\n";
		$out.= "<ord:orderSummary>\n";
			$out.= "<ord:roundingDocument>math2one</ord:roundingDocument>\n";
		$out.= "</ord:orderSummary>\n";
	$out.= "</ord:order>\n";
	$out.= "</dat:dataPackItem>\n\n";
};

$out.= "</dat:dataPack>\n";

header ("Content-Type:text/xml");
header ('char-set: UTF-8');
//~ @file_put_contents('./dl/response/'.microtime(true).'.txt', $out);
//~ @file_put_contents('php://output', $out);
@file_put_contents('Orders_Perc_script.xml', $out);
@file_put_contents('php://output', $out);
