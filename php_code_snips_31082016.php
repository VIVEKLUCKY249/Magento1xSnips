<?php
## Check if a value exists in a multi-dimensional array begin
function in_array_r($needle, $haystack, $strict = false) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
			return true;
		}
	}
	return false;
}
## Check if a value exists in a multi-dimensional array end

## Check if a value exists in a multi-dimensional array start
function in_array_r($needle, $haystack, $strict = false) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
			return true;
		}
	}
	return false;
}
## Check if a value exists in a multi-dimensional array finish

## PHP Extract Link URL & Label from HTML Content start
### Below line fetches only URLs from HTML Links
## preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $menuBlockContent, $linkUrls);
preg_match_all("/\<a.*href=\"(.*?)\".*?\>(.*)\<\/a\>+/", $anyHtmlContent, $linkData, PREG_SET_ORDER);
var_dump($linkData);
## PHP Extract Link URL & Label from HTML Content finish

## PHP Extract content inside <body> tags start
preg_match("/<body[^>]*>(.*?)<\/body>/is", $html, $matches);
$content = $matches[1];
## PHP Extract content inside <body> tags end

## Magento Zend Debug for debugging objects
Mage::log(
	$object->debug(), //Objects extending Varien_Object can use this
	Zend_Log::DEBUG,  //Log level
	'<filename>.log',         //Log file name; if blank, will use config value (system.log by default)
	true              //force logging regardless of config setting
);

Mage::log("Object Info: ".print_r($object->debug(), true), null, '<filename>.log');
Mage::log('Object Info:-'.Zend_Debug::dump($object, null, false), null, '<filename>.log');

// Function for logging into any log file start:
/// Add below function to class you're working in.
private function _doLog($logline, $filename = null)
{
	$logDir = Mage::getBaseDir('log');
	
	if(is_null($filename)) $fh = fopen($logDir."/trollweb_bring.log", "a");
	else $fh = fopen($logDir."/$filename", "a+");
			
	if(is_array($logline) || is_object($logline)) {
		ob_start();
		echo "<pre/>";print_r($logline);
		$logline = ob_get_clean();
	}
	
	if ($fh) {
		fwrite($fh, "[".date("d.m.Y h:i:s")."] ".$logline."\n");
		fclose($fh);
	}
}
/// Function call
$this->_doLog($resource, 'customFile.log');
// Function for logging into any log file finish....

/**
 * For debugging only remove after debugging process done
 */
# Function to debug collections which can't be debugged the usual way, starts:
## Add below function is collection class itself, $this = collection object
public function _afterLoad() {
	$selectSql = $this->getSelect()->__toString();
	$rowsPerSql = $this->count();
	$items = $this->getItems();
	return parent::_afterLoad();
}
## This magic method is called automatically by Magento system.
# Function to debug collections which can't be debugged the usual way, ends....
?>
