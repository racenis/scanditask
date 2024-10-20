<?php

require "page.php";
require "template.php";

class IndexPage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product List");
		
		?>
		<form action="index.php" method="post">
		
		<table>
			<tr>
				<td width="600">
					<h1>
						Product List
					</h1>
				</td>
				<td>
					<button onclick="location.href='add-item.php'" type="button">Add</button>
					<input type="submit" value="Mass Delete"/>
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
							<input type="checkbox" name="<?php echo $item->getSKU(); ?>"/>
						
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

		</form>
		
		<?php
		
		$template->emitEnd();
	}
	
	public function setCollection($collection) {
		$this->collection = $collection;
	}
	
	private $collection = null;
};

?>