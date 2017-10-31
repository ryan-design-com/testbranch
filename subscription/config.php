<?php



	error_reporting(1);

	//error_reporting(E_ALL);	

	

	//Connection to lcoal database

	// ryan dev server dev.ryan-desing.com

	define("DB_SERVER", "localhost");
	define("DB_NAME", "pmcmmnts_db1");
	define("DB_USER", "pmcmmnts_dbusr01");
	define("DB_PASS", "!^iyU;AHm4#=");			



	





	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);

	mysql_select_db(DB_NAME, $connection) or die(mysql_error());

?>