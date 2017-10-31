<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}


function pageRedirect(){
	redirect_to('register_forms.php');
}


if($_POST['action'] == "addnew"){

	// error chedking
	$POST_user_name = trim($_POST['name']);
	
	if($POST_user_name == ""){
		$session->message("<font color='#FF0000'>Not Added</font> :: Name Required");
		pageRedirect();
	}	
	
	// check if name already exsists
	$sqlName = "SELECT * FROM  casl_register_forms WHERE name='{$POST_user_name}' LIMIT 1";
	if(RegisterForms::find_by_sql($sqlName)){
		$session->message("<font color='#FF0000'>Not Added</font> :: name already exists");
		pageRedirect();
	}	
	
	$builder_accoutns = new RegisterForms();
	
	$builder_accoutns->active = ($_POST['active'] == "on" ? 1 : 0);

	$builder_accoutns->name = $_POST['name'];
	$builder_accoutns->form_table_name = $_POST['form_table_name'];
	$builder_accoutns->notes = $_POST['notes'];

	
	if($builder_accoutns->save()) {
		// Success
		$session->message("New bulder added successfully. ");
		
	} else {
		// Failure
		$session->message("<span style='color:#FF0000; font-weight:bold;'>Not able to add new builder.</span>");
	}	


}else if($_POST['action'] == "update"){
	
	// error chedking
	$POST_user_name = trim($_POST['name' . $_POST['id']]);
	
	if($POST_user_name == ""){
		$session->message("<font color='#FF0000'>Not Updated</font> :: Name Required");
		pageRedirect();
	}	
	
	// check if name already exsists
	$sqlName = "SELECT * FROM  casl_register_forms WHERE name='{$POST_user_name}' AND id != " . $database->escape_value($_POST['id']) . " LIMIT 1";
	if(RegisterForms::find_by_sql($sqlName)){
		$session->message("<font color='#FF0000'>Not updated</font> :: duplicate name");
		pageRedirect();
	}		
	$builder_accoutns = RegisterForms::find_by_id($_POST['id']);
	
	$builder_accoutns->active = ($_POST['active' . $_POST['id']] == "on" ? 1 : 0);
	

	$builder_accoutns->name = $_POST['name' . $_POST['id']];
	$builder_accoutns->form_table_name = $_POST['form_table_name' . $_POST['id']];
	$builder_accoutns->notes = $_POST['notes' . $_POST['id']];

	
	$builder_accoutns->save();
	
	$session->message("Form updated " . $_POST['name' . $_POST['id']] . " " . $_POST['id']);
	
}else if($_POST['action'] == "delete"){
	  $builder_accoutns = RegisterForms::find_by_id($_POST['id']);
	  if($builder_accoutns && $builder_accoutns->delete()) {
		$session->message("Form - " . $_POST['name']);
	  } else {
		$session->message("Form could not be deleted.");
	  }		
}

pageRedirect();

?>


<?php if(isset($database)) { $database->close_connection(); } ?>
