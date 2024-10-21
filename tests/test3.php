<?php

/*
	This test will try to write some stuff from the database.
	
	WARNING: database will be written to. Make sure that test database is
	set up to be written to.
*/

require_once "../logic/listitem.php";

Logger::setConsoleDebug(true);

$sku = "kaidkadka-183982197";
$name = "Very nice item.";
$price = 2.00;

$list_item = new ListItem($sku);

$list_item->setName($name);
$list_item->setPrice($price);

$db = new Database;

$list_item->insert($db);


$another_item = new ListItem($sku);

$another_item->load($db);

assert($another_item->getName() == $name);
assert($another_item->getPrice() == $price);

var_dump($another_item->getName());
var_dump($another_item->getPrice());

?>