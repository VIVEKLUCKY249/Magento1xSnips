<?php
## Functions to get data from

### GetInventory
### GetInventoryByQuery

$wsdl = "https://api.ongoingsystems.se/Colliflow/service.asmx?wsdl";

$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

$client = new SoapClient($wsdl, array('trace' => true));

try{
    ## $response = $client->GetFileList(array("UserName"=>"norelkowsitest", "Password"=>"d6yaThuG"));
    $orderByOrderNumber = $client->GetOrderByOrderNumber(array("UserName"=>"norelkowsitest", "Password"=>"d6yaThuG", "GoodsOwnerCode" => "Norelko Test", "OrderNumber" => "test_1234"));
    
    ## echo "<pre/>";print_r($response->GetOrderByOrderNumberResult->Consignee);die;
    
    $orderStatuses = $client->GetOrderStatuses(array("UserName"=>"norelkowsitest", "Password"=>"d6yaThuG", "GoodsOwnerCode" => "Norelko Test"));
    
    $inventoryByQuery = $client->GetInventoryByQuery(array("UserName" => "norelkowsitest", "Password" => "d6yaThuG", "GoodsOwnerCode" => "Norelko Test", "GetInventoryQuery" => array("ArticleNumbersToGet" => array("test"))));
    
    //$inventoryQuery = $client->GetInventoryQuery(array("ArticleNumbersToGet" => 'test'));
    
    echo "<pre/>";print_r($inventoryByQuery);die;
    
    $object2Array = json_decode(json_encode($inventoryQuery), true);
    echo "<pre/>";print_r($object2Array);die;
} catch(Exception $e) {
    echo "Error!";
    echo $e->getMessage();
}
echo $client->__getlastRequest();
exit("<br/>Api execution terminated !!!");
?>
