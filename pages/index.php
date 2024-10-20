<?php

require "page.php";
require "template.php";

class IndexPage implements Page {
	public function emit($collection) {
		$template = new Template;
		$template->emitBegin("Index");
		
		
		
		
		
		
		$template->emitEnd();
	}
};

?>