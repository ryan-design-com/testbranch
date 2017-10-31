<?php
header("Cache-Control: no-cache");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registrants Admin Panel</title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link type="text/css" media="screen" rel="stylesheet" href="../colorbox.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

		<script type="text/javascript" src="../colorbox/jquery.colorbox.js"></script>
        
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css">
		<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
        
        <script src="js/jquery.validate.js"></script>
        
		<script src="js/jquery-ui-timepicker-addon.js"></script>

</head>

<body class="twoColFixLtHdr">

<div id="container">
  <div id="header">
  	<div id="corpLogo"><a href="index.php"><img src="images/ryanDesign_logo.png" border="0" /></a></div>
  	
    <div id="headerHeading"><h1>Ryan Design Registrants Control Panel</h1></div>
    
<?php
if($session->is_logged_in()){   
?> 
    <div id="headerLogout"><a href="logout.php">LOGOUT</a></div>
<?php    
}
?>
  <!-- end #header --></div>
  <div id="sidebar1">
    <h3>SELECTION MENU</h3>
    
<?php
if($session->is_logged_in()){   

	$currentPagePath = $_SERVER['PHP_SELF'];
	$currentPagePathArray = explode("/", $currentPagePath);
	$currentPageName = $currentPagePathArray[(count($currentPagePathArray) - 1)];


?> 
    <ul id="adminMenuUL">
    	<li <?php echo ($currentPageName ==  "index.php") ? ('class="selected"') : (""); ?>><a href="index.php">Home</a></li>
        
<?php
	if($session->user_id == 1){    
?>	
    	<li <?php echo ($currentPageName ==  "users.php") ? ('class="selected"') : (""); ?>><a href="users.php">User Administration</a></li>
    	<li <?php echo ($currentPageName ==  "register_forms.php") ? ('class="selected"') : (""); ?>><a href="register_forms.php">Registarion Forms</a></li>
            
<?php


		
	}

/*
	$builder_accounts = RegisterForms::find_all();
	
	foreach($builder_accounts as $builder_account):
		$builder_account->name;
		$builder_account->form_table_name;
?>        
		<li <?php echo ($currentPageName ==  "registrants.php") ? ('class="selected"') : (""); ?>><a href="registrants.php?name=<?php echo $builder_account->name; ?>&tbl=<?php echo $builder_account->form_table_name; ?>"><?php echo $builder_account->name; ?></a></li>
<?php	
	endforeach;

*/
?>        
        

   </ul>   
<?php    

	
	
	//print_r($projectDirArray);
}
?>
    </ul>


	<br /><br /><br /><br /><br /><br /> <br /><br /><br /> <br /><br /> <br /><br /><br />   
    
  <br class="clearfloat" />
  <div id="leftCustLogo" align="center"></div>
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
  	&nbsp;
<?php

/*
echo "session_name : " .  session_name() . "<br>";

echo "phpSelfArray : " .  count($phpSelfArray) . "<br>";


echo $_SERVER['DOCUMENT_ROOT'] . "<br>";


echo date("l Y-m-d h:i a");
echo "<br>";
echo date("l Y-m-d h:i a", mktime());
echo "<br>";
*/

if($session->message()){
?>
<div id="messageWindow"><span style='color:#FF0000; font-weight:bold;'> >> </span><span style='color:#090; font-weight:bold;'><?php echo $session->message(); ?></span></div>
<?php    
}


?>
    