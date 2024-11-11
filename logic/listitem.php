<?php

require_once "database.php";

/**
	Special property of a ListItem.
	
	This will be displayed on the store page, each type having a different
	property.
*/
class ListItemSpecialProperty {
	public function __construct(string $name, string $value, string $unit) {
		$this->name = $name;
		$this->value = $value;
		$this->unit = $unit;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function getUnit() {
		return $this->unit;
	}
	
	protected string $name;
	protected string $value;
	protected string $unit;
};

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
	
	/**
		Returns the item's special property, if it has one.
		
		@return Either a property or a null.
	*/
	public function getSpecialProperty() : ?ListItemSpecialProperty {
		return null;
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
	
	public function getSpecialProperty() : ?ListItemSpecialProperty {
		return new ListItemSpecialProperty("Size", "{$this->size}", "MB");
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
	
	public function getSpecialProperty() : ?ListItemSpecialProperty {
		return new ListItemSpecialProperty("Weight", "{$this->weight}", "KG");
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
	
	public function getSpecialProperty() : ?ListItemSpecialProperty {
		return new ListItemSpecialProperty("Dimension", "{$this->getHeight()}x{$this->getWidth()}x{$this->getLength()}", "");
	}
	
	private ?float $width = null;
	private ?float $height = null;
	private ?float $length = null;
};

class ListItemFactory {
	/**
		Returns a string name of the type that the factory is producing.
	*/
	public function getName() : string {
		return "Item";
	}
	
	/**
		Constructs an instance of a class from a database query.
	*/
	public function getInstanceFromDBQuery($row) : ?ListItem {
		return null;
	}
	
	/**
		Constructs an instance of a class from a post request.
	*/
	public function getInstanceFromPost($post) : ?ListItem {
		return null;
	}
	
	/**
		Registers a factory.
	*/
	public static function register(ListItemFactory $factory) {
		ListItemFactory::$factory_list[$factory->getName()] = $factory;
	}
	
	/**
		Creates a ListItem instance with the appropriate type.
	*/
	public static function buildFromDB($props) : ?ListItem {
		foreach (ListItemFactory::$factory_list as $factory) {
			$new_item = $factory->getInstanceFromDBQuery($props);
			
			if (!is_null($new_item)) return $new_item;
		}
		
		return null;
	}
	
	/**
		Creates a ListItem instance with the appropriate type.
	*/
	public static function buildFromPost($request) : ?ListItem {
		foreach (ListItemFactory::$factory_list as $factory) {
			$new_item = $factory->getInstanceFromPost($request);
			
			if (!is_null($new_item)) return $new_item;
		}

		return null;
	}
	
	
	private static $factory_list = [];
};

class DVDDiscFactory extends ListItemFactory {
	public function __construct() {
		ListItemFactory::register($this);
	}
	
	public function getName() : string {
		return "DVD";
	}
	
	public function getInstanceFromDBQuery($props) : ?ListItem {
		if (is_null($props["size"])) return null;
		
		$item = new DVDDisc($props["sku"]);
		$item->setName($props["name"]);
		$item->setPrice($props["price"]);
		$item->setSize($props["size"]);
		
		return $item;
	}
	
	public function getInstanceFromPost($post) : ?ListItem {
		if ($post["productType"] != "DVD") return null;
		
		$item = new DVDDisc($post["sku"]);
		$item->setName($post["name"]);
		$item->setPrice($post["price"]);
		$item->setSize($post["size"]);
		
		return $item;
	}
};

$dvddisc_factory = new DVDDiscFactory;

class BookFactory extends ListItemFactory {
	public function __construct() {
		ListItemFactory::register($this);
	}
	
	public function getName() : string {
		return "Book";
	}
	
	public function getInstanceFromDBQuery($props) : ?ListItem {
		if (is_null($props["weight"])) return null;
		
		$item = new Book($props["sku"]);
		$item->setName($props["name"]);
		$item->setPrice($props["price"]);
		$item->setWeight($props["weight"]);
		
		return $item;
	}
	
	public function getInstanceFromPost($post) : ?ListItem {
		if ($post["productType"] != "Book") return null;
		
		$item = new Book($post["sku"]);
		$item->setName($post["name"]);
		$item->setPrice($post["price"]);
		$item->setWeight($post["weight"]);
		
		return $item;
	}
};

$book_factory = new BookFactory;

class FurnitureFactory extends ListItemFactory {
	public function __construct() {
		ListItemFactory::register($this);
	}
	
	public function getName() : string {
		return "Furniture";
	}
	
	public function getInstanceFromDBQuery($props) : ?ListItem {
		if (is_null($props["width"])
			|| is_null($props["height"])
			|| is_null($props["length"])) return null;
		
		$item = new Furniture($props["sku"]);
		$item->setName($props["name"]);
		$item->setPrice($props["price"]);
		$item->setWidth($props["width"]);
		$item->setHeight($props["height"]);
		$item->setLength($props["length"]);
		
		return $item;
	}
	
	public function getInstanceFromPost($post) : ?ListItem {
		if ($post["productType"] != "Furniture") return null;
		
		$item = new Furniture($post["sku"]);
		$item->setName($post["name"]);
		$item->setPrice($post["price"]);
		$item->setWidth($post["width"]);
		$item->setHeight($post["height"]);
		$item->setLength($post["length"]);
		
		return $item;
	}
};

$furniture_factory = new FurnitureFactory;

?>