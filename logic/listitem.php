<?php

require "database.php";

/**
	Basic store item.
*/
class ListItem {
	
	/**
		Constructs the ListItem.
		
		After construction it can be filled out either via calling field setter
		methods, or looked up in a database by calling load().
		
		@param $sku Need to input a SKU identifier. Must be globally unique.
	*/
	public function __construct(string $sku) {
		$this->sku = $sku;
		
		$this->name = null;
		$this->price = null;
	}
	
	/**
		Loads the ListItem from DB.
	*/
	public function load(DatabaseInterface $db) : void {
		
		// TODO: implement
		
	}
	
	/**
		Saves the ListItem to DB.
		
		This only works if the item has already been inserted into the database.
		Use insert() to insert it.
	*/
	public function save(DatabaseInterface $db) : void {
		
		// TODO: implement
		
	}
	
	/**
		Inserts the ListItem into the database for the first time.
	*/
	public function insert(DatabaseInterface $db) : void {
		
		$db->query("helloo;");
		
		// TODO: implement
		
	}
	
	/**
		Removes the ListItem from the database.
	*/
	public function remove(DatabaseInterface $db) : void {
		
		// TODO: implement
		
	}
	
	/**
		Returns the SKU identifier of the item.
	*/
	public function getSKU() : string {
		return $this->sku;
	}
	
	/**
		Returns the name of the item.
	*/
	public function getName() : string {
		assert(!is_null($this->name));
		
		return $this->name;
	}
	
	/**
		Sets the name of the item.
	*/
	public function setName(string $name) : void {
		$this->name = $name;
	}
	
	/**
		Returns the price of the item.
	*/
	public function getPrice() : float {
		assert(!is_null($this->price));
		
		return $this->price;
	}
	
	/**
		Sets the price of the item.
	*/
	public function setPrice(float $price) : void {
		$this->price = $price;
	}
	
	/**
		Checks if the item's fields can be accessed.
		
		If the item hasn't been initialized via a database lookup or by manually
		filling out all of the fields, some of them can be nulls. This will
		check for that.
		
		@return True if all of the fields are initialized.
	*/
	public function isReady() : bool {
		return !is_null($this->name) and !is_null($this->price);
	}
	
	
	private string $sku;
	
	private ?string $name;
	private ?float $price;
};

class DVDDisc extends {
	
	
};

?>