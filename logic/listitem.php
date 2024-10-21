<?php

require_once "database.php";

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
		assert(!empty($sku));
		
		$this->sku = $sku;
		
		$this->name = null;
		$this->price = null;
	}
	
	/**
		Loads the ListItem from DB.
	*/
	public function load(DatabaseInterface $db) : void {
		$result = $db->query("select name, price from items where sku='$this->sku'");
		
		if (sizeof($result) != 1) {
			throw new Exception("Item sku '$this->sku' not found in DB.");
		} 
		
		$this->name = $result[0][0];
		$this->price = $result[0][1];
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
		assert($this->isReady());
		
		$db->query("insert into items (sku, name, price) values ('$this->sku', '$this->name', $this->price)");
	}
	
	/**
		Removes the ListItem from the database.
	*/
	public function remove(DatabaseInterface $db) : void {
		$db->query("delete from items where sku='$this->sku'");
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
		assert(!empty($name));
		
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
		assert($price >= 0.0); // I assume we don't allow negative prices
		
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
	
	
	protected string $sku;
	
	protected ?string $name;
	protected ?float $price;
};



/**
	DVD disc item.
*/
class DVDDisc extends ListItem {
	
	public function load(DatabaseInterface $db) : void {
		ListItem::load($db);
		
		$result = $db->query("select size from dvds where sku='$this->sku'");
		
		if (sizeof($result) != 1) {
			throw new Exception("DVDDisc sku '$this->sku' not found in DB.");
		} 
		
		$this->size = $result[0][0];
	}

	public function save(DatabaseInterface $db) : void {
		throw new Exception("Not implemented.");
	}

	public function insert(DatabaseInterface $db) : void {
		assert($this->isReady());
		
		ListItem::insert($db);
		
		// if this fails, we should probably roll back the previous insertion.
		// in the base class.
		$db->query("insert into dvds (sku, size) values ('$this->sku', $this->size)");
	}

	public function remove(DatabaseInterface $db) : void {
		ListItem::remove($db);
	}
	
	/**
		Returns the size of the disc in megabytes.
	*/
	public function getSize() : float {
		assert(!is_null($this->size));
		
		return $this->size;
	}
	
	/**
		Sets the size of the disc in megabytes.
	*/
	public function setSize(float $size) : void {
		assert($size >= 0.0);
		assert($size < 20.0 * 1024.0); // there's probably no DVDs this large
		
		$this->size = $size;
	}
	
	public function isReady() : bool {
		return !is_null($this->size) and ListItem::isReady();
	}
	
	private ?float $size = null;
};



/**
	Book item.
*/
class Book extends ListItem {
	
	public function load(DatabaseInterface $db) : void {
		ListItem::load($db);
		
		$result = $db->query("select weight from books where sku='$this->sku'");
		
		if (sizeof($result) != 1) {
			throw new Exception("Book sku '$this->sku' not found in DB.");
		} 
		
		$this->weight = $result[0][0];
	}

	public function save(DatabaseInterface $db) : void {
		throw new Exception("Not implemented.");
	}

	public function insert(DatabaseInterface $db) : void {
		assert($this->isReady());
		
		ListItem::insert($db);
		
		$db->query("insert into books (sku, weight) values ('$this->sku', $this->weight)");
	}

	public function remove(DatabaseInterface $db) : void {
		ListItem::remove($db);
	}
	
	/**
		Returns the weight of the book in kilograms.
	*/
	public function getWeight() : float {
		assert(!is_null($this->weight));
		
		return $this->weight;
	}
	
	/**
		Sets the weight of the book in kilograms.
	*/
	public function setWeight(float $weight) : void {
		assert($weight >= 0.0);
		
		$this->weight = $weight;
	}
	
	public function isReady() : bool {
		return !is_null($this->weight) and ListItem::isReady();
	}
	
	private ?float $weight = null;
};



/**
	Furniture item.
*/
class Furniture extends ListItem {
	
	public function load(DatabaseInterface $db) : void {
		ListItem::load($db);
		
		$result = $db->query("select width, height, length from furnitures where sku='$this->sku'");
		
		if (sizeof($result) != 1) {
			throw new Exception("Furnitures sku '$this->sku' not found in DB.");
		} 
		
		$this->width = $result[0][0];
		$this->height = $result[0][1];
		$this->length = $result[0][2];
	}

	public function save(DatabaseInterface $db) : void {
		throw new Exception("Not implemented.");
	}

	public function insert(DatabaseInterface $db) : void {
		assert($this->isReady());
		
		ListItem::insert($db);
		
		$db->query("insert into furnitures (sku, width, height, length) values ('$this->sku', $this->width, $this->height, $this->length)");
	}

	public function remove(DatabaseInterface $db) : void {
		ListItem::remove($db);
	}
	
	/**
		Returns the width of the furniture in arbitrary units.
	*/
	public function getWidth() : float {
		assert(!is_null($this->width));
		
		return $this->width;
	}
	
	/**
		Sets the width of the furniture in arbitrary units.
	*/
	public function setWidth(float $width) : void {
		assert($width >= 0.0);
		
		$this->width = $width;
	}
	
	/**
		Returns the width of the furniture in arbitrary units.
	*/
	public function getHeight() : float {
		assert(!is_null($this->height));
		
		return $this->height;
	}
	
	/**
		Sets the width of the furniture in arbitrary units.
	*/
	public function setHeight(float $height) : void {
		assert($height >= 0.0);
		
		$this->height = $height;
	}
	
	/**
		Returns the width of the furniture in arbitrary units.
	*/
	public function getLength() : float {
		assert(!is_null($this->length));
		
		return $this->length;
	}
	
	/**
		Sets the width of the furniture in arbitrary units.
	*/
	public function setLength(float $length) : void {
		assert($length >= 0.0);
		
		$this->length = $length;
	}
	
	public function isReady() : bool {
		return !is_null($this->width)
			and !is_null($this->height)
			and !is_null($this->length)
			and ListItem::isReady();
	}
	
	private ?float $width = null;
	private ?float $height = null;
	private ?float $length = null;
};



?>