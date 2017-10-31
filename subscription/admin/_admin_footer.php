<br class="clearfloat" />
<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <div id="footer">
    <div id="copyright">&copy; copyright <?php echo date("Y"); ?></div><div id="ryanLogo"><a href="http://www.ryan-design.com" target="_blank"><img src="images/ryan-logo.png" border="0" /></a></div>
  <!-- end #footer --></div>
<!-- end #container --></div>

<?php


//$var_array = get_defined_vars();
//print_r($var_array);


?>

</body>
</html>

<?php if(isset($database)) { $database->close_connection(); } ?>