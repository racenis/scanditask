<?php

require_once "pages/add-item.php";
require_once "logic/listitem.php";

class AddItemPageGlue {
	public function __construct() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$success = true;
			
			// I am not going to do any validation here, I will just let the
			// program throw exceptions.
			
			// I hope that no-one tries to do a SQL injection here.
			// It would be very neat if someone actually bothered to do so.
			try {
				$item = ListItemFactory::buildFromPost($_POST);
				
				$database = new Database;
				
				$item->insert($database);
				
			} catch (\Throwable $e) {
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
	}
};

$glue = new AddItemPageGlue;

?>