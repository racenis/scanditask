<?php

/*
	This test checks basics about how the ListItems get save to databases and
	that sort of thing.	
*/

require_once "../logic/listitem.php";

Logger::setConsoleDebug(true);

class ListItemDBMock extends MockDatabase {	
	public function query(string $query) {
		$this->was_queried = true;
		
		MockDatabase::query($query);
		
		return null;
	}
	
	public bool $was_queried = false;
};


$sku = "dauwduiadni-34194891";
$price = 0.10;
$name = "Item #1";

// creating a new list item and checking if its parameters get properly
// registered and stuff.
$list_item = new ListItem($sku);

assert(!$list_item->isReady());

$list_item->setPrice($price);
$list_item->setName($name);

assert($list_item->isReady());

assert($list_item->getSKU() == $sku);
assert($list_item->getPrice() == $price);
assert($list_item->getName() == $name);


// checking if it can be inserted into the database
$db_mock = new ListItemDBMock;

assert(!$db_mock->was_queried);

$list_item->insert($db_mock);

assert($db_mock->was_queried);

Logger::getInstance()->write("Test finished.");

?>