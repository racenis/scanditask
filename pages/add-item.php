<?php

require_once "page.php";
require_once "template.php";

class AddItemPage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product Add");
		
		?>
			<form action="add-item.php" id="product_form" method="post" onsubmit="return validate_all()">
		
			<table>
				<tr>
					<td width="600">
						<h1>
							Product Add
						</h1>
					</td>
					<td>
						<input type="submit" value="Save"/>
						<button onclick="location.href='./'" type="button">Cancel</button>
					</td>
				</tr>
			</table>
			
			<hr/>
		
			
		
			<table width="200" border="2">
				<tr id="general-error" style="display:none">
					<td colspan="2">
						<font color="red">
							There are fields with missing values. We will not
							allow to proceed. Not allow to proceed until this
							situation has been rectified.
						</font>
					</td>
				</tr>
			
				<tr id="sku-error" style="display:none">
					<td colspan="2">
						<font color="red">
							The SKU is having a difficulty. Please reconsider.
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<label id="sku-label" for="sku">SKU</label>
					</td>
					<td>
						<input type="text" id="sku" name="sku" onchange="validate_sku()"/>
					</td>
				</tr>
				
				<tr id="name-error" style="display:none">
					<td colspan="2">
						<font color="red">
							The Name is having a difficulty. Please reconsider.
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<label id="name-label" for="name">Name</label>
					</td>
					<td>
						<input type="text" id="name" name="name" onchange="validate_name()"/>
					</td>
				</tr>
				
				<tr id="price-error" style="display:none">
					<td colspan="2">
						<font color="red">
							The price is inadequate. Please reconsider.
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<label id="price-label" for="name">Price ($)</label>
					</td>
					<td>
						<input type="text" id="price" name="price" onchange="validate_price()"/>
					</td>
				</tr>
				
				<tr>
					<td>
						<label id="productType-label" for="productType">Type Switcher</label>
					</td>
					<td>
						<select id="productType" name="productType" onchange="product_change()">
							<option id="DVD" value="DVD" selected>DVD</option>
							<option id="Book" value="Book">Book</option>
							<option id="Furniture" value="Furniture">Furniture</option>
						</select>
					</td>
				</tr>
				
				<tr class="disc-options">
					<td colspan="2">
						Provide the disc size informaton. This is a helpful description.
					</td>
				</tr>
				<tr id="size-error" class="disc-options" style="display:none">
					<td colspan="2">
						<font color="red">
							The size is inadequate. Please reconsider.
						</font>
					</td>
				</tr>
				<tr class="disc-options">
					<td>
						<label id="size-label" for="size">Size (MB)</label>
					</td>
					<td>
						<input type="text" id="size" name="size" onchange="validate_size()"/>
					</td>
				</tr>
			

				<tr class="book-options" style="display:none">
					<td colspan="2">
						Provide the book weight informaton. This is a helpful description.
					</td>
				</tr>
				<tr id="weight-error" class="book-options" style="display:none">
					<td colspan="2">
						<font color="red">
							The weight is inadequate. Please reconsider.
						</font>
					</td>
				</tr>
				<tr class="book-options" style="display:none">
					<td>
						<label id="weight-label" for="weight">Weight (KG)</label>
					</td>
					<td>
						<input type="text" id="weight" name="weight" onchange="validate_weight()"/>
					</td>
				</tr>

				

				<tr class="furniture-options" style="display:none">
					<td colspan="2">
						Provide the dimensions of the furniture. This is a helpful description. If this is not a helpful description, contact the webmaster at <a href="mailto:webmaster@scanditest.cz">webmaster@scanditest.cz</a>.
					</td>
				</tr>
				<tr id="dimension-error" style="display:none" class="furniture-options">
					<td colspan="2">
						<font color="red">
							The dimesnions are inadequate. Please reconsider.
						</font>
					</td>
				</tr>
				<tr class="furniture-options" style="display:none">
					<td>
						<label id="height-label" for="height">Height</label>
					</td>
					<td>
						<input type="text" id="height" name="height" onchange="validate_dimension()"/>
					</td>
				</tr>
				<tr class="furniture-options" style="display:none">
					<td>
						<label id="width-label" for="width">Width</label>
					</td>
					<td>
						<input type="text" id="width" name="width" onchange="validate_dimension()"/>
					</td>
				</tr>
				<tr class="furniture-options" style="display:none">
					<td>
						<label id="length-label" for="length">Length</label>
					</td>
					<td>
						<input type="text" id="length" name="length" onchange="validate_dimension()"/>
					</td>
				</tr>
			</table>

			</form> 
	
		
		<?php
		
		$template->emitEnd();
	}
}


class AddItemSuccessPage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product Success", "<meta http-equiv=\"refresh\" content=\"3;url=./\"/>\n");
		
		?>
		<marquee>
			<font color="green">
				<h1>
					VERY SUCCESSFUL!
				</h1>
			</font>
		</marquee>
		
		<center>
			<font color="green">
				<img src="assets/frog3.gif"/>
				<img src="assets/frog4.gif"/>
				<img src="assets/frog5.gif"/>
				<h3>
					FORM SUBMITTED SUCCESSFULLY.
				</h3>
				<a href="./">CLICK HERE FOR REDIRECT!</a>
			</font>
		</center>
		
		<?php
		
		$template->emitEnd();
	}
}

class AddItemFailurePage implements Page {
	public function emit() {
		$template = new Template;
		$template->emitBegin("Product Success", "<meta http-equiv=\"refresh\" content=\"3;url=add-product\"/>\n");
		
		?>
		<marquee>
			<font color="red">
				<h1>
					<img src="assets/danger.gif"/>
					VERY UNSUCCESSFUL!
					<img src="assets/danger.gif"/>
				</h1>
			</font>
		</marquee>
		
		<center>
			<font color="red">
				<h3>
					FORM FAILED TO SUBMIT. YOU WILL HAVE TO RE-ENTER ALL OF THE
					DATA IN THE FORM.
				</h3>
				<a href="add-item.php">CLICK HERE FOR REDIRECT!</a>
			</font>
		</center>
		
		<?php
		
		$template->emitEnd();
	}
}