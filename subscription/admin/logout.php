<?php
require_once('includes/initialize.php');

$session->logout();

if(!$session->is_logged_in()){
	redirect_to("login.php");
}


?>