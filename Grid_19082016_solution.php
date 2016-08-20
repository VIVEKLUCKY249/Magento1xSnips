<?php
class Mage_Adminhtml_Block_Sales_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('sales_order_grid');
		$this->setUseAjax(true);
		$this->setDefaultSort('created_at');
		$this->setDefaultDir('DESC');
		$this->setSaveParametersInSession(true);
	}
	/**
	 * Retrieve collection class
	 *
	 * @return string
	 */
	protected function _getCollectionClass()
	{
		return 'sales/order_grid_collection';
	}
	protected function _prepareCollection()
	{
		$collection = Mage::getResourceModel($this->_getCollectionClass());
		$collection->join(array('payment' => 'sales/order_payment'),'main_table.entity_id = parent_id','method');
		//Edit Starts:
		$collection->getSelect()->join(array('sfo' => 'sales_flat_order'), 'main_table.entity_id = sfo.entity_id',array('shipping_method' =>'shipping_method'));
		//Edit Ends:
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns()
	{
		$this->addColumn('real_order_id', array(
			'header'=> Mage::helper('sales')->__('Order #'),
			'width' => '80px',
			'type'  => 'text',
			'index' => 'increment_id',
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header'    => Mage::helper('sales')->__('Purchased From (Store)'),
				'index'     => 'store_id',
				'type'      => 'store',
				'store_view'=> true,
				'display_deleted' => true,
			));
		}
		$this->addColumn('created_at', array(
			'header' => Mage::helper('sales')->__('Purchased On'),
			'index' => 'created_at',
			'type' => 'datetime',
			'width' => '100px',
		));
		$this->addColumn('billing_name', array(
			'header' => Mage::helper('sales')->__('Bill to Name'),
			'index' => 'billing_name',
		));
		$this->addColumn('shipping_name', array(
			'header' => Mage::helper('sales')->__('Ship to Name'),
			'index' => 'shipping_name',
		));
		$payments = Mage::getSingleton('payment/config')->getActiveMethods();
		$methods = array();
		foreach($payments as $paymentCode => $paymentModel) {
			$paymentTitle = Mage::getStoreConfig('payment/'.$paymentCode.'/title');
			$methods[$paymentCode] = $paymentTitle;
		}
		$this->addColumn('method', array(
			'header' => Mage::helper('sales')->__('Payment Method'),
			'index' => 'method',
			'filter_index' => 'method',
			'type'  => 'options',
			'width' => '70px',
			'options' => $methods,
		));
		//Edit Starts:
		$methods = Mage::getSingleton('shipping/config')->getActiveCarriers();
		$shippingmethods = array();
		foreach($methods as $_ccode => $_carrier) {
			if($_methods = $_carrier->getAllowedMethods()) {
				if(!$_title = Mage::getStoreConfig("carriers/$_ccode/title")) $_title = $_ccode;
				foreach($_methods as $_mcode => $_method) {
					if($_mcode != 'flatrate' && $_mcode != 'freeshipping') $_title = $_ccode.' - '.$_method;
					$_code = $_ccode . '_' . $_mcode;
					$shippingmethods[$_code] = $_title;
				}
			}
		}
		$this->addColumn('shipping_method', array(
			'header'=> Mage::helper('sales')->__('Shipping Method'),
			'width' => '80px',
			'type'  => 'options',
			'filter_index' => 'sfo.shipping_method',
			'index' => 'shipping_method',
			'options' => $shippingmethods,
		));
		//Edit ends.......
		$this->addColumn('base_grand_total', array(
			'header' => Mage::helper('sales')->__('G.T. (Base)'),
			'index' => 'base_grand_total',
			'type'  => 'currency',
			'currency' => 'base_currency_code',
		));
		$this->addColumn('grand_total', array(
			'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
			'index' => 'grand_total',
			'type'  => 'currency',
			'currency' => 'order_currency_code',
		));
		$this->addColumn('status', array(
			'header' => Mage::helper('sales')->__('Status'),
			'index' => 'status',
			'type'  => 'options',
			'width' => '70px',
			'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
		));
		if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
			$this->addColumn('action',
				array(
					'header'    => Mage::helper('sales')->__('Action'),
					'width'     => '50px',
					'type'      => 'action',
					'getter'     => 'getId',
					'actions'   => array(
						array(
							'caption' => Mage::helper('sales')->__('View'),
							'url'     => array('base'=>'*/sales_order/view'),
							'field'   => 'order_id',
							'data-column' => 'action',
						)
					),
					'filter'    => false,
					'sortable'  => false,
					'index'     => 'stores',
					'is_system' => true,
			));
		}
		$this->addRssList('rss/order/new', Mage::helper('sales')->__('New Order RSS'));
		$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
		$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel XML'));
		return parent::_prepareColumns();
	}
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('entity_id');
		$this->getMassactionBlock()->setFormFieldName('order_ids');
		$this->getMassactionBlock()->setUseSelectAll(false);
		if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/cancel')) {
			$this->getMassactionBlock()->addItem('cancel_order', array(
				 'label'=> Mage::helper('sales')->__('Cancel'),
				 'url'  => $this->getUrl('*/sales_order/massCancel'),
			));
		}
		if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/hold')) {
			$this->getMassactionBlock()->addItem('hold_order', array(
				 'label'=> Mage::helper('sales')->__('Hold'),
				 'url'  => $this->getUrl('*/sales_order/massHold'),
			));
		}
		if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/unhold')) {
			$this->getMassactionBlock()->addItem('unhold_order', array(
				 'label'=> Mage::helper('sales')->__('Unhold'),
				 'url'  => $this->getUrl('*/sales_order/massUnhold'),
			));
		}
		$this->getMassactionBlock()->addItem('pdfinvoices_order', array(
			 'label'=> Mage::helper('sales')->__('Print Invoices'),
			 'url'  => $this->getUrl('*/sales_order/pdfinvoices'),
		));
		$this->getMassactionBlock()->addItem('pdfshipments_order', array(
			 'label'=> Mage::helper('sales')->__('Print Packingslips'),
			 'url'  => $this->getUrl('*/sales_order/pdfshipments'),
		));
		$this->getMassactionBlock()->addItem('pdfcreditmemos_order', array(
			 'label'=> Mage::helper('sales')->__('Print Credit Memos'),
			 'url'  => $this->getUrl('*/sales_order/pdfcreditmemos'),
		));
		$this->getMassactionBlock()->addItem('pdfdocs_order', array(
			 'label'=> Mage::helper('sales')->__('Print All'),
			 'url'  => $this->getUrl('*/sales_order/pdfdocs'),
		));
		$this->getMassactionBlock()->addItem('print_shipping_label', array(
			 'label'=> Mage::helper('sales')->__('Print Shipping Labels'),
			 'url'  => $this->getUrl('*/sales_order_shipment/massPrintShippingLabel'),
		));
		return $this;
	}
	public function getRowUrl($row)
	{
		if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
			return $this->getUrl('*/sales_order/view', array('order_id' => $row->getId()));
		}
		return false;
	}
	public function getGridUrl()
	{
		return $this->getUrl('*/*/grid', array('_current'=>true));
	}
}
