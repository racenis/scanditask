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
							<?php echo $this->getSpecialProperty($item); ?>
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
	
	private function getSpecialProperty($item) {
		$props = $item->getSpecialProperty();
		
		if (is_null($props)) return "";
		
		return "{$props->GetName()}: {$props->GetValue()} {$props->GetUnit()}";
	}
	
	private $collection = null;
};

?>