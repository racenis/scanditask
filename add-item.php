<?php

require "pages/add-item.php";
require "logic/listitem.php";

class AddItemPageGlue {
	public function __construct() {
		
		// TODO: add a check for POST
		// if this is getting posted, then check which items need to be yeeted
		// and then yeet them.
		
		//$database = new Database;
		
		//$collection = new MainPageCollection;
		//$collection->load($database);
		
		$page = new AddItemPage();
		
		//$page->setCollection($collection);
		$page->emit();
	}
};

$glue = new AddItemPageGlue;

?>