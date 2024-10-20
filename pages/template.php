<?php

class Template {
	function emitBegin($page_title, $header_content = "") {
		?>
		<!doctype html>
		<html>
			<head>
				<title>
					<?php echo $page_title; ?>
				</title>
				<script src="assets/pagescript.js"></script>
				<?php echo $header_content; ?>
			</head>
			<body bgcolor="black">
				<font color="white">
					<center>
						<table width="800">
							<tr>
								<td>
		<?php
	}
	
	function emitEnd() {
		?>
									<hr/>
									<center>
										website 2024
									</center>
								</td>
							</tr>
						</table>
					</center>
				</font>
			</body>
		</html>
		<?php
	}
}





?>