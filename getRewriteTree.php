<?php
require_once 'app/Mage.php';
Varien_Profiler::enable();
Mage::setIsDeveloperMode(true);
error_reporting(E_ALL);
ini_set('display_errors', 1);
umask(0);
Mage::app('default');
#echo "<pre/>"; print_r(Mage::getConfig()->getNode()->xpath('//global//rewrite')); die("<br/>Data printed above !!!");
$text = Mage::getConfig()->getNode()->xpath('//global//rewrite');
foreach ($text as $rewriteElement) {
    if($rewriteElement->getParent()->getParent()) {
        $type = $rewriteElement->getParent()->getParent()->getName();//what is overwritten (model, block, helper)
        $parent = $rewriteElement->getParent()->getName();//module identifier that is being rewritten (core, catalog, sales, ...)
        $name = $rewriteElement->getName();//element that is rewritten (layout, product, category, order)
        foreach ($rewriteElement->children() as $element) {
            $rewrites[$type][$parent.'/'.$name][] = $element;//class that rewrites it
        }
    }
}
echo "<pre/>"; print_r($rewrites); die;
