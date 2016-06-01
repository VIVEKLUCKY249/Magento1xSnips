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

## Get Product Attribute Option Id by Option text
$_product = Mage::getModel('catalog/product');
$attr = $_product->getResource()->getAttribute("<attribute_code>");
if ($attr->usesSource()) {
	$optionId = $attr->getSource()->getOptionId("<option_text>");
}
## For example
$_product = Mage::getModel('catalog/product');
$attr = $_product->getResource()->getAttribute("color");
if ($attr->usesSource()) {
	echo $color_id = $attr->getSource()->getOptionId("Purple");
}

## Get product attribute option text by option id
$_product = Mage::getModel('catalog/product');
$attr = $_product->getResource()->getAttribute("<attribute_code>");
if ($attr->usesSource()) {
	$optionText = $optionLabel = $attr->getSource()->getOptionText("<option_id>");
}

## Log function usable in any class
public function log($logline)
   {
    $logDir = Mage::getBaseDir('log');

    $fh = fopen($logDir."/sm_tripletex.log","a");
    if ($fh) {
      fwrite($fh,"[".date("d.m.Y h:i:s")."] ".$logline."\n");
      fclose($fh);
    }
   }
   
## Get label of specified value from System > Config setting of module/core_admin when field is of type 'select'
protected function _getSystemConfigValueLabel($path, $value) {
        $config = Mage::getConfig()->loadModulesConfiguration('system.xml')->applyExtends();
        
        $newPath = '';
        $parts = explode('/', $path);
        if (count($parts) != 3) {
            return '';
        }
        $newPath = 'sections/'.$parts[0].'/groups/'.$parts[1].'/fields/'.$parts[2];
        
        $node = $config->getNode($newPath);
        
        if ($node && $node->source_model) {
            $model = Mage::getSingleton((string)$node->source_model);
            $options = $model->toOptionArray();
        }
        
        foreach($options as $country):
            if($country['value'] == $value):
                return $country['label'];
            endif;
        endforeach;
}

## Get System > Config value and existing form value when in edit mode
if (strpos($_SERVER['REQUEST_URI'], "edit") !== false)
    $existingData = Mage::registry('module_data')->getData();
$defaultCountry = Mage::getStoreConfig('mycompany/general/defaultcountry', Mage::app()->getStore());
$defaultCountryName = $this->_getSystemConfigValueLabel('pstorelocator/general/defaultcountry', $defaultCountry);

//String cannot be checked against integer 0 for comparison/condition
<?php
if ($country != 0) //is wrong condition
if ($country != null) //correct

## Get store details and Url by storeCode start
public function getStoreByCode($storeCode)
{
	$stores = array_keys(Mage::app()->getStores());
	foreach($stores as $id) {
		$store = Mage::app()->getStore($id);
		if($store->getCode() == $storeCode) {
			return $store;
		}
	}
	## If no store found
	return Mage::app()->getStore();
}
	
public function getStoreUrlByCode($storeCode)
{
	$stores = array_keys(Mage::app()->getStores());
	foreach($stores as $id) {
		$store = Mage::app()->getStore($id);
		if($store->getCode() == $storeCode) {
			return $store->getUrl('');
		}
	}
	## If no store found
	return Mage::app()->getStore()->getUrl('');
}
## Get store details and Url by storeCode finish

## Get percentage discount on product price start
$_product = $product;
$originalPrice = $_product->getPrice();
$finalPrice = $_product->getFinalPrice();
$percentage = 0;

if ($originalPrice > $finalPrice) {
	$percentage = ($originalPrice - $finalPrice) * 100 / $originalPrice;
}

if ($percentage) {
	echo $this->__('You save %s', round($percentage, 2) . '%');
}
## Get percentage discount on product price finish

## Debug without fopen or log start
file_put_contents("/home/web00093/public_html/debugTotals455.log", print_r($order->debug(), true), FILE_APPEND);
## Debug without fopen or log end

## To override PDF in Magento 1.9.x
/*http://inchoo.net/magento/how-to-add-custom-attribute-to-magentos-pdf-invoice/

other wise you can modify the following files putting into local code pool.

 /app/code/core/Mage/Sales/Model/Order/Pdf/Invoice.php
 /app/code/core/Mage/Sales/Model/Order/Pdf/Abstract.php
 */
 ## To override PDF in Magento 1.9.x end

## Modfy address alignment
/**
     * Insert address to pdf page
     *
     * @param Zend_Pdf_Page $page
     * @param null $store
     */
    protected function insertAddress(&$page, $store = null)
    {
        $page->setFillColor(new Zend_Pdf_Color_GrayScale(0));
        $font = $this->_setFontRegular($page, 10);
        $page->setLineWidth(0);
        $this->y = $this->y ? $this->y : 815;
        $top = 815;
        foreach (explode("\n", Mage::getStoreConfig('sales/identity/address', $store)) as $value) {
            if ($value !== '') {
                $value = preg_replace('/<br[^>]*>/i', "\n", $value);
                foreach (Mage::helper('core/string')->str_split($value, 45, true, true) as $_value) {
                ## $alignRight = $this->getAlignRight($_value, 130, 440, $font, 10);
                $alignRight = 423.70;
                ## Mage::log(print_r($alignRight, true),NULL, 'pdfALignRight.log');
                    $page->drawText(trim(strip_tags($_value)),
                        $alignRight,
                        $top,
                        'UTF-8');
                    $top -= 10;
                }
            }
        }
        $this->y = ($this->y > $top) ? $top : $this->y;
    }
  ## Modify address alignment end

## Get stores and set their links start
$allStores = Mage::app()->getStores();
?>
<div class="links-wrapper-separators">
<ul class="links">
    <?php foreach($allStores as $store) { 
    if($store->getId() == 1) $storeLabel = "Privatkunde";
    else $storeLabel = "Bedriftskunde"; ?>
<li class="hide-below-768"><a title="See the list of all features" href="<?php echo Mage::helper('infortis')->getStoreUrlByCode($store->getCode()); ?>"><?php echo $storeLabel; ?></a></li>
<?php } ?>
</ul>
</div>
<?php
## Get stores and set their links end

 11
down vote
	

I have used following command to get different URL in magento Get Url in phtml files

1. Get Base Url :

Mage::getBaseUrl();

2. Get Skin Url :

Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);

(a) Unsecure Skin Url :

$this->getSkinUrl('images/imagename.jpg');

(b) Secure Skin Url :

$this->getSkinUrl('images/imagename.gif', array('_secure'=>true));

3. Get Media Url :

Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

4. Get Js Url :

Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS);

5. Get Store Url :

Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);

6. Get Current Url

Mage::helper('core/url')->getCurrentUrl();

Get Url in cms pages or static blocks

1. Get Base Url :

{{store url=""}}

2. Get Skin Url :

{{skin url='images/imagename.jpg'}}

3. Get Media Url :

{{media url='/imagename.jpg'}}

4. Get Store Url :

{{store url='mypage.html'}}

I think this will help you.

## Log all sql queries in Magento CE 1.9.x start
### Replace the "query" function in /lib/Varien/Db/Adapter/Pdo/Mysql.php with the below function
/**
 * Special handling for PDO query().
 * All bind parameter names must begin with ':'.
 *
 * @param string|Zend_Db_Select $sql The SQL statement with placeholders.
 * @param mixed $bind An array of data or data itself to bind to the placeholders.
 * @return Zend_Db_Statement_Pdo
 * @throws Zend_Db_Adapter_Exception To re-throw PDOException.
 */
  public function query($sql, $bind = array())
  {
      $this->_debugTimer();
      try {
          $sql = (string)$sql;
          if (strpos($sql, ':') !== false || strpos($sql, '?') !== false) {
              $this->_bindParams = $bind;
              ## $sql = preg_replace_callback('#((["])((2)|((.*?[^\])2))")#', array($this, 'proccessBindCallback'), $sql);
              $sql = preg_replace_callback("/#(([\\'\"])((2)|((.*?[^\\\\])2)))#/", array($this, 'proccessBindCallback'), $sql);
              $bind = $this->_bindParams;
          }
          $code = 'SQL: ' . $sql . "\r\n";
          if ($bind) {
              $code .= 'BIND: ' . print_r($bind, true) . "\r\n";
          }
          $this->_debugWriteToFile("[".date('Y-m-d H:i:s')."] ".$code);
          $result = parent::query($sql, $bind);
      }
      catch (Exception $e) {
          $this->_debugStat(self::DEBUG_QUERY, $sql, $bind);
          $this->_debugException($e);
      }
      $this->_debugStat(self::DEBUG_QUERY, $sql, $bind, $result);
      return $result;
  }
  ### All queries will be logged in "magento_root/var/debug/pdo_mysql.log" file.
## Log all sql queries in Magento CE 1.9.x finish

## Find out in which file "Headers already sent..." error occurs start
### Edit the file <magento_root>/lib/Zend/Controller/Response/Abstract.php and make "canSendHeaders" function look like below:
/**
 * Can we send headers?
 *
 * @param boolean $throw Whether or not to throw an exception if headers have been sent; defaults to false
 * @return boolean
 * @throws Zend_Controller_Response_Exception
 */
public function canSendHeaders($throw = false)
{
    $ok = headers_sent($file, $line);
    if ($ok && $throw && $this->headersSentThrowsException) {
        #require_once 'Zend/Controller/Response/Exception.php';
        throw new Zend_Controller_Response_Exception('Cannot send headers; headers already sent in ' . $file . ', line ' . $line);
    }
    if ($ok) Mage::log('Cannot send headers; headers already sent in ' . $file . ', line ' . $line);
    if ($ok) Mage::log('Cannot send headers; headers already sent in ' . $file . ', line ' . $line, null, 'developerDebug.log');
    return !$ok;
}
### Save the file. Run the site and check the "developerDebug.log" file.
## Find out in which file "Headers already sent..." error occurs finish

## Find from where does "... cannot be serialized" error comes from start
### Add the below code to any template file at the bottom, probably 'footer.phtml'
function tloc_is_iterable($var) {
    return (is_array($var) || $var instanceof Traversable);
}

function tloc_find_unserializable($var, $tab=false) {
    if (!$tab) {
        $tab = "\t";
    }

    if (tloc_is_iterable($var)) {
        foreach ($var as $key => $each) {
            if (is_resource($each)) {
                echo $tab . '<span style="color: #090;">'.$key.'</span> -> Resource' . "\n";
            } else {
                try {
                    serialize($each);

                    // if serialization doesn't error
                    echo $tab . '<span style="color: #090;">'.$key.'</span>' . "\n";
                } catch (Exception $e) {
                    echo $tab . '<span style="color: #f40;">';
                    if (!tloc_is_iterable($each)) {
                        echo '<strong><i>' . $key . '</i></strong>';
                    } else {
                        echo $key;
                    }

                    echo '</span>';
                    if (is_object($each)) {
                        echo ' -> '.get_class($each);
                    }
                    echo "\n";
                }
            }

            if (tloc_is_iterable($each)) {
                tloc_find_unserializable($each, $tab."\t");
            }
        }
    }
}
echo '<pre style="background-color: #fff; color: #000;">';
tloc_find_unserializable($_SESSION);
echo '</pre>';
### Find the sections in 'red' color those are the ones that tries to serialize but cannot
## Find from where does "... cannot be serialized" error comes from end

## Log any resource in Magento 1.x with full information start
$filePath = __FILE__;$lineNum = __LINE__;$methodName = __METHOD__;
Mage::log(print_r($resource, true)." from file:".$filePath." at line:".$lineNum." from method:".$methodName, NULL, 'developerDebug.log');
Mage::log($resource." from file:".$filePath." at line:".$lineNum." from method:".$methodName, NULL, 'developerDebug2.log');
## Log any resource in Magento 1.x with full information finish

## Log PHP function with as many details as possible start
function f1() {
  $fileinfo = null;
  $backtrace = debug_backtrace();
  if (!empty($backtrace[0]) && is_array($backtrace[0])) {
    $fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];
  }
  echo "calling file info: $fileinfo\n";
}
### Call it as below:
f1();
## Log PHP function with as many details as possible end
?>
?>
