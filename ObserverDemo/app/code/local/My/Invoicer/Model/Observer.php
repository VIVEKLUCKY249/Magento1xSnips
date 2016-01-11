<?php
class My_Invoicer_Model_Observer
{
    /**
     * Mage::dispatchEvent($this->_eventPrefix.'_save_after', $this->_getEventData());
     * protected $_eventPrefix = 'sales_order';
     * protected $_eventObject = 'order';
     * event: sales_order_save_after
     */
    public function automaticallyInvoiceShipCompleteOrder($observer)
    {
        $order = $observer->getEvent()->getOrder();

        $orders = Mage::getModel('sales/order_invoice')->getCollection()
                        ->addAttributeToFilter('order_id', array('eq'=>$order->getId()));
        $orders->getSelect()->limit(1);

        if ((int)$orders->count() !== 0) {
            return $this;
        }

        if ($order->getState() == Mage_Sales_Model_Order::STATE_NEW) {

            try {
                if(!$order->canInvoice()) {
                    $order->addStatusHistoryComment('My_Invoicer: Order cannot be invoiced.', false);
                    $order->save();  
                }

                //START Handle Invoice
                $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();

                $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_OFFLINE);
                $invoice->register();

                $invoice->getOrder()->setCustomerNoteNotify(true);          
                $invoice->getOrder()->setIsInProcess(true);
                $invoice->sendEmail(true, '');
                $order->addStatusHistoryComment('Automatically INVOICED by My_Invoicer.', false);

                $transactionSave = Mage::getModel('core/resource_transaction')
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder());

                $transactionSave->save();

                //END Handle Invoice

                //START Handle Shipment
                //~ $shipment = $order->prepareShipment();
                //~ $shipment->register();
 //~ 
                //~ $order->setIsInProcess(true);
                //~ $order->addStatusHistoryComment('Automatically SHIPPED by My_Invoicer.', false);
 //~ 
                //~ $transactionSave = Mage::getModel('core/resource_transaction')
                    //~ ->addObject($shipment)
                    //~ ->addObject($shipment->getOrder())
                    //~ ->save();
                //END Handle Shipment
            } catch (Exception $e) {
                $order->addStatusHistoryComment('My_Invoicer: Exception occurred during automaticallyInvoiceShipCompleteOrder action. Exception message: '.$e->getMessage(), false);
                $order->save();
            }                
        }

		return $this;
    }
	
	public function createInvoice($observer) {
		$order = $observer->getEvent()->getOrder();
		
		$orders = Mage::getModel('sales/order_invoice')->getCollection()
                        ->addAttributeToFilter('order_id', array('eq'=>$order->getId()));
        $orders->getSelect()->limit(1);
		
		if ((int)$orders->count() !== 0) {
            return $this;
        }
		
        $orderState = $order->getState();
        if ($orderState === Mage_Sales_Model_Order::STATE_NEW) { // Check for state new.
            if ($order->canInvoice()) {
                $order->getPayment()->setSkipTransactionCreation(false);
                $invoice = $order->prepareInvoice();
                $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
				Mage::log(get_class($invoice), null, 'debugCv.log');
                $invoice->register();
                Mage::getModel('core/resource_transaction')
                   ->addObject($invoice)
                   ->addObject($order)
                   ->save();
            }
            else {
				exit("Order cannot be Invoiced!!!");
            }
        }
    }
}
