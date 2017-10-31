<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}



function getProjectsDropDown(){
	global $database;


	
	
}




require_once('_admin_header.php');


?>

	<h1> Welcome </h1>
    <p><?php 
	

	$builder_accounts = RegisterForms::find_all();
	
	foreach($builder_accounts as $builder_account):
		$builder_account->name;
		$builder_account->form_table_name;
?>        
		<?php echo $builder_account->name; ?> <a href="registrants_csv.php?name=<?php echo $builder_account->name; ?>&tbl=<?php echo $builder_account->form_table_name; ?>">Download CSV File</a><br>
<?php	
	endforeach;


?>        
        
	
<?php

require_once('_admin_footer.php');

?>