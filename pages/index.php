<?php

require_once "page.php";
require_once "template.php";

class IndexPage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product List");
		
		?>
		<form action="./" method="post">
		
		<table>
			<tr>
				<td width="600">
					<h1>
						Product List
					</h1>
				</td>
				<td>
					<button onclick="location.href='add-product'" type="button">ADD</button>
					<input type="submit" value="MASS DELETE"/>
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
							<input type="checkbox" class="delete-checkbox" name="<?php echo $item->getSKU(); ?>"/>
						
							<?php echo $item->getSKU(); ?>
							<br/>
							<?php echo $item->getName(); ?>
							<br/>
							<?php echo $item->getPrice(); ?>$
							<br/>
							<?php echo $this->descriptionMapping($item); ?>
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
	
	private function descriptionMapping($list_item) {
		if (!isset($this->item_mapping[get_class($list_item)])) {
			return "<i>N/A</i>";
		}

		return $this->item_mapping[get_class($list_item)]($list_item);
	}
	
	public function __construct() {
		$this->item_mapping = [
			DVDDisc::class => function($item) {
				return "Size: {$item->getSize()} MB";
			},
			Book::class => function($item) {
				return "Weight: {$item->getWeight()} KG";
			},
			Furniture::class => function($item) {
				return "Dimension: {$item->getWidth()}x{$item->getHeight()}x{$item->getLength()}";
			}];
	}
	
	private $item_mapping = null;
	private $collection = null;
};

?>