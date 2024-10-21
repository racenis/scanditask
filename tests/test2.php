<?php

/*
	This test checks if specific list items get created and all well.
*/

require_once "../logic/listitem.php";

Logger::setConsoleDebug(true);

$dvd_sku = "ljaghlaghajhfgj-910490";
$dvd_name = "Very nice DVD. Definitely not a bootleg.";
$dvd_price = 3.50;
$dvd_size = 4.7 * 1024.0;

$book_sku = "ljaghlaghajhfgj-910490";
$book_name = "Very nice book. Unused, previous owners never even read it.";
$book_price = 9.15;
$book_weight = 10.0;

$furniture_sku = "åhdsfööeiqöljhåsdfljäsf-23892389";
$furniture_name = "Very nice chair. Never sat on.";
$furniture_price = 49.99;
$furniture_width = 3.0;
$furniture_height = 4.0;
$furniture_length = 5.0;

$db_mock = new MockDatabase;

$dvd = new DVDDisc($dvd_sku);
$dvd->setName($dvd_name);
$dvd->setPrice($dvd_price);
assert(!$dvd->isReady());

$dvd->setSize($dvd_size);
assert($dvd->isReady());

$dvd->insert($db_mock);


$book = new Book($book_sku);
$book->setName($book_name);
$book->setPrice($book_price);
assert(!$book->isReady());

$book->setWeight($book_weight);
assert($book->isReady());

$book->insert($db_mock);


$furniture = new Furniture($furniture_sku);
$furniture->setName($furniture_name);
$furniture->setPrice($furniture_price);
assert(!$furniture->isReady());

$furniture->setWidth($furniture_width);
$furniture->setHeight($furniture_height);
$furniture->setLength($furniture_length);
assert($furniture->isReady());

$furniture->insert($db_mock);


assert($dvd->getSKU() == $dvd_sku);
assert($dvd->getName() == $dvd_name);
assert($dvd->getPrice() == $dvd_price);
assert($dvd->getSize() == $dvd_size);

assert($book->getSKU() == $book_sku);
assert($book->getName() == $book_name);
assert($book->getPrice() == $book_price);
assert($book->getWeight() == $book_weight);

assert($furniture->getSKU() == $furniture_sku);
assert($furniture->getName() == $furniture_name);
assert($furniture->getPrice() == $furniture_price);
assert($furniture->getWidth() == $furniture_width);
assert($furniture->getHeight() == $furniture_height);
assert($furniture->getLength() == $furniture_length);

Logger::getInstance()->write("Test finished.");

?>