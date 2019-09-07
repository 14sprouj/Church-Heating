<html>
<!--<//?php include_once('functions.php'); ?>-->
<?php echo file_get_contents("header.html"); ?>
<h2>Dashboard</h2>
System Date <?php date_default_timezone_set("Europe/London"); echo date('D d/m/Y h:i:s a');

?>
<table>
	<tr>
		<td>
			<svg height="300" width="480">
				<rect height="410pt" width="510pt" style="fill:rgb(255,255,0);"></rect>
				<text x="165" y="60" fill="black" font-size="32pt" font-family="Arial">Room 1</text>
				<text x="25" y="150" fill="black" font-size="45pt" font-family="Arial">Status Unknown</text>
				<text x="120" y="190" fill="black" font-size="14pt" font-family="Arial">Go to the troubleshoot section</text>
				<text x="110" y="210" fill="black" font-size="14pt" font-family="Arial">of this website to solve the issue</text>
				Sorry, your browser does not support inline SVG.

			</svg>
		</td>
		<td>
			<svg height="300" width="480">
				<rect height="410pt" width="510pt" style="fill:rgb(255,255,0);"></rect>
				<text x="165" y="60" fill="black" font-size="32pt" font-family="Arial">Room 2</text>
				<text x="25" y="150" fill="black" font-size="45pt" font-family="Arial">Status Unknown</text>
				<text x="120" y="190" fill="black" font-size="14pt" font-family="Arial">Go to the troubleshoot section</text>
				<text x="110" y="210" fill="black" font-size="14pt" font-family="Arial">of this website to solve the issue</text>
				Sorry, your browser does not support inline SVG.

			</svg>
		</td>
		<td>
			<svg height="300" width="480">
				<rect height="410pt" width="510pt" style="fill:rgb(255,255,0);"></rect>
				<text x="165" y="60" fill="black" font-size="32pt" font-family="Arial">Room 3</text>
				<text x="25" y="150" fill="black" font-size="45pt" font-family="Arial">Status Unknown</text>
				<text x="120" y="190" fill="black" font-size="14pt" font-family="Arial">Go to the troubleshoot section</text>
				<text x="110" y="210" fill="black" font-size="14pt" font-family="Arial">of this website to solve the issue</text>
				Sorry, your browser does not support inline SVG.

			</svg>
		</td>
	</tr>
</table>

<?php echo file_get_contents("footer.html"); ?>

<script>
var unknowns = document.getElementsByClassName("unknown");
var unknowCont = unknown.getContext("2d");
unknowCont.fillStyle = "#ff0";
unknowCont.fillRect(0, 0, 150, 75);
</script>
