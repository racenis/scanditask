<?php

require "pages/index.php";
require "logic/listitemcollection.php";

class IndexPageGlue {
	public function __construct() {
		$database = new Database;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach ($_POST as $key => $value) {
				if ($value != "on") continue;
				
				$item = new ListItem($key);
				
				$item->remove($database);
			}
		} 
		
		$collection = new MainPageCollection;
		$collection->load($database);
		
		$page = new IndexPage();
		
		$page->setCollection($collection);
		$page->emit();
	
	}
};

$glue = new IndexPageGlue;

?>