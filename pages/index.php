<?php

require "page.php";
require "template.php";

class IndexPage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product List");
		
		?>
		<table>
			<tr>
				<td width="600">
					<h1>
						Product List
					</h1>
				</td>
				<td>
					Add | Delete
				</td>
			</tr>
		</table>
		
		<hr/>

		<table>
			<tr>
				<?php

				$elements_added = 0;
				
				foreach ($this->collection as $item) {
					if ($elements_added >= 4) {
						$elements_added = 0;
						
						?>
						 </tr>
						 <tr>
						<?php
					}
					$elements_added++;
					
					?>
					<td>
						<center>
							<?php echo $item->getSKU(); ?>
							<br/>
							<?php echo $item->getName(); ?>
							<br/>
							<?php echo $item->getPrice(); ?>$
							<br/>
							<?php
								switch(true) {  
									case $item instanceof DVDDisc:
										echo "{$item->getSize()} MB";
										break;
									case $item instanceof Book:
										echo "{$item->getWeight()} KG";
										break;
									case $item instanceof Furniture:
										echo "{$item->getWidth()}x{$item->getHeight()}x{$item->getLength()}";
										break;
									default:
										echo "<i>N/A</i>";
										break;
								}
							?>
						</center>
					</td>
					<?php
				}
				
				
				
				
				?>
				
			</tr>
		</table>

		<?php
		
		$template->emitEnd();
	}
	
	public function setCollection($collection) {
		$this->collection = $collection;
	}
	
	private $collection = null;
};

?>