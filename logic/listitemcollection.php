<?php

require "listitem.php";

/**
	Generic list of ListItems.

	Can be iterated over using a foreach loop.
*/
class ListItemCollection {

	/**
		Loads the item collection from the database.
		
		@note This method is meant to be overriden by subclasses.
	*/
	public function load(DatabaseInterface $db) {
		throw new Exception("ListItemCollection cannot be loaded.");
	}

	/** 
		Adds a ListItem to the collection.
	*/
	public function append(ListItem $item) {
		array_push($this->items, $item);
	}
	
	public function rewind() : void {
		$this->position = 0;
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
	
	private var items = [];
	private int current_item = 0;
};

/**
	List of the items on the main page.
*/
class MainPageCollection extends ListItemCollection {
	
	/**
		Loads items for the main page.
	*/
	public function load(DatabaseInterface $db) {
		throw new Exception("MainPageCollection cannot be loaded.");
		
		// TODO: implement
	}
}


?>