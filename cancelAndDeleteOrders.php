<?php
require_once('app/Mage.php');
Mage::app('admin');
Mage::getSingleton("core/session", array("name" => "adminhtml"));
Mage::register('isSecureArea',true);
$collection = Mage::getResourceModel('sales/order_collection')
					->addAttributeToSelect('*')
					## ->addFieldToFilter('status', 'canceled')
					->addFieldToFilter('customer_id', 5602)
					->load();

foreach ($collection as $col) {
	$order = $col;

	if ($order->canCancel()) {
		try {
				$order->cancel();
				echo "Order ".$col->getIncrementId()." is now cancelled <br/>";

				// remove status history set in _setState
				$order->getStatusHistoryCollection(true);

				// do some more stuff here
				// ...

				$order->save();
		} catch (Exception $e) {
				Mage::logException($e);
		}
	}

	try {
		$col->delete();
		echo "Order ".$col->getIncrementId()." is now deleted <br/>";
	} catch (Exception $e) {
		throw $e;
	}
}
?>
