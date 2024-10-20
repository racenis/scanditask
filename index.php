<?php

require "pages/index.php";
require "logic/listitem.php";

class IndexPageGlue {
	public function __construct() {
		$collection = ListItemCollection;
		
		$list_item = new ListItem("toobaboopa");

		$list_item->setName("tattatata");
		$list_item->setPrice(1239183401924);
		
		$collection->append($list_item);
		$collection->append($list_item);
		$collection->append($list_item);
		$collection->append($list_item);
		$collection->append($list_item);
		
		$page = new IndexPage();
		
		$page->Emit($collection);
	}
};

$glue = IndexPageGlue;

?>