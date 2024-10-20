<?php

require "listitem.php";

/**
	Generic list of ListItems.

	Can be iterated over using a foreach loop.
*/
class ListItemCollection implements Iterator {

	/**
		Loads the item collection from the database.
		
		@note This method is meant to be overriden by subclasses.
	*/
	public function load(DatabaseInterface $db) : void {
		throw new Exception("ListItemCollection cannot be loaded.");
	}

	/** 
		Adds a ListItem to the collection.
	*/
	public function append(ListItem $item) {
		array_push($this->items, $item);
	}
	
	public function rewind() : void {
		$this->current_item = 0;
	}

	public function current() {
		return $this->items[$this->current_item];
	}

	public function key() {
		return $this->current_item;
	}

	public function next() : void {
		$this->current_item++;
	}

	public function valid() : bool {
		return isset($this->items[$this->current_item]);
	}
	
	protected $items = [];
	protected int $current_item = 0;
};

/**
	List of the items on the main page.
*/
class MainPageCollection extends ListItemCollection {
	
	public function load(DatabaseInterface $db) : void {
		$db_items = $db->query("select items.sku, items.name, items.price, dvds.size, books.weight, furnitures.width, furnitures.height, furnitures.length from items left join dvds on items.sku = dvds.sku left join books on items.sku = books.sku left join furnitures on items.sku = furnitures.sku order by items.sku");
		
		foreach ($db_items as $db_item) {
			$item = null;
			
			if (!is_null($db_item[3])) {
				$item = new DVDDisc($db_item[0]);
				$item->setName($db_item[1]);
				$item->setPrice($db_item[2]);
				$item->setSize($db_item[3]);
			} else if (!is_null($db_item[4])) {
				$item = new Book($db_item[0]);
				$item->setName($db_item[1]);
				$item->setPrice($db_item[2]);
				$item->setWeight($db_item[4]);
			} else if (!is_null($db_item[5]) and !is_null($db_item[6]) and !is_null($db_item[7])) {
				$item = new Furniture($db_item[0]);
				$item->setName($db_item[1]);
				$item->setPrice($db_item[2]);
				$item->setWidth($db_item[5]);
				$item->setHeight($db_item[6]);
				$item->setLength($db_item[7]);
			} else {
				$item = new ListItem($db_item[0]);
				$item->setName($db_item[1]);
				$item->setPrice($db_item[2]);
			}

			$this->append($item);
		}
	}
	
}


?>