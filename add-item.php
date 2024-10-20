<?php

require "pages/add-item.php";
require "logic/listitem.php";

class AddItemPageGlue {
	public function __construct() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$success = true;
			
			// I am not going to do any validation here, I will just let the
			// program throw exceptions.
			
			// I hope that no-one tries to do a SQL injection here.
			// It would be very neat if someone actually bothered to do so.
			try {
				$item = null;
				
				switch ($_POST["productType"]) {
					case "DVD":
						$item = new DVDDisc($_POST["sku"]);
						$item->setSize($_POST["size"]);
						break;
					case "Book":
						$item = new Book($_POST["sku"]);
						$item->setWeight($_POST["weight"]);
						break;
					case "Furniture":
						$item = new Furniture($_POST["sku"]);
						$item->setWidth($_POST["width"]);
						$item->setHeight($_POST["height"]);
						$item->setLength($_POST["length"]);
						break;
					default:
						$item = new ListItem($_POST["sku"]);
				}
				
				$item->setName($_POST["name"]);
				$item->setPrice($_POST["price"]);
				
				$database = new Database;
				
				$item->insert($database);
				
			} catch (Exception $e) {
				$success = false;
			}
			
			
			
			
			// we could send the user back to the form, but with all of the
			// submitted data filled in. we will not do this.
			
			// we will instead torture the user by forcing them to re-enter all
			// of the data in the form
			
			if ($success) {
				$page = new AddItemSuccessPage();
				$page->emit();
			} else {
				// no error message. we could pass in an error message, but we
				// already have a validator on the front end.
				$page = new AddItemFailurePage();
				$page->emit();
			}
			
		} else {
			$page = new AddItemPage();
			$page->emit();
		}
		
		
		
		// TODO: add a check for POST
		// if this is getting posted, then check which items need to be yeeted
		// and then yeet them.
		
		//$database = new Database;
		
		//$collection = new MainPageCollection;
		//$collection->load($database);
		
		
		
		//$page->setCollection($collection);
		
	}
};

$glue = new AddItemPageGlue;

?>