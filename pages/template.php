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
			<body background="assets/sky1.gif">
				<font color="white">
					<center>
						<table width="800" bgcolor="black">
							<tr>
								<td>
		<?php
	}
	
	function emitEnd() {
		?>
									<hr/>
									<center>
										Scandiweb Test assignment
									</center>
									<hr/>
									<center>
										<img src="assets/800x600.gif"/>
										<img src="assets/drpepper.gif"/>
										<img src="assets/esheep.gif"/>
										<img src="assets/hicolor.gif"/>
										<img src="assets/mysql5.gif"/>
										<img src="assets/notepadpp.gif"/>
										<img src="assets/valid-bad.gif"/>
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