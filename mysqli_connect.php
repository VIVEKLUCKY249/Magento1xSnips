<?php

//define("_MAGENTO_ROOT",dirname(__FILE__)."/../");
define("_MAGENTO_ROOT",dirname(__FILE__));

$file = _MAGENTO_ROOT . "/app/etc/local.xml"; 

$xml = simplexml_load_file($file);

$host = $xml->global->resources->default_setup->connection->host;
$username = $xml->global->resources->default_setup->connection->username;
$password = $xml->global->resources->default_setup->connection->password;
$dbname = $xml->global->resources->default_setup->connection->dbname;

/*mysql_connect($host, $username, $password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

$query = "select value, value_id from catalog_product_entity_text where attribute_id = 72 order by value_id asc #limit 100";

$descriptions = mysql_query($query) or die(mysql_error());

while ($description = mysql_fetch_assoc($descriptions)) 
{ 
//update and save back to db 
}*/

$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Perform queries
$queryResult = mysqli_query($conn, "SELECT value, value_id FROM `catalog_product_entity_text` WHERE attribute_id = 72 ORDER BY value_id ASC LIMIT 50");

while($row = $queryResult->fetch_row()) {
	$rows[] = $row;
}
$queryResult->close();

echo "<pre/>";print_r($rows);

echo "<pre/>";print_r($queryResult);die("BYE!!!");
## mysqli_query($conn, "INSERT INTO Persons (FirstName,LastName,Age) VALUES ('Glenn','Quagmire',33)");

mysqli_close($conn);
?>