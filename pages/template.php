<?php

class Template {
	function emitBegin($page_title) {
		?>
		<!doctype html>
		<html>
			<head>
				<title>
					<?php echo $page_title; ?>
				</title>
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