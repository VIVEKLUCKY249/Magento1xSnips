<?php
    /**
     * Create recurring payment profiles basing on the current items
     *
     * @return array
     */
    public function prepareRecurringPaymentProfiles()
    {
        if (!$this->getTotalsCollectedFlag()) {
            // Whoops! Make sure nominal totals must be calculated here.
            throw new Exception('Quote totals must be collected before this operation.');
        }

        $result = array();
        foreach ($this->getAllVisibleItems() as $item) {
            $product = $item->getProduct();
            if (is_object($product) && ($product->isRecurring())
                && $profile = Mage::getModel('sales/recurring_profile')->importProduct($product)
            ) {
                $profile->importQuote($this);
                $profile->importQuoteItem($item);
                $result[] = $profile;
            }
        }
        return $result;
    }
