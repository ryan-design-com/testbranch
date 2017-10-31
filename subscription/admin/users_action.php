<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}


function pageRedirect(){
	redirect_to('users.php');
}


if($_POST['action'] == "addnew"){

	// error chedking
	$POST_user_name = trim($_POST['user_name']);
	
	if($POST_user_name == ""){
		$session->message("<font color='#FF0000'>Not Added</font> :: User Name Required");
		pageRedirect();
	}	
	
	// check if name already exsists
	$sqlName = "SELECT * FROM casl_users WHERE user_name='{$POST_user_name}' LIMIT 1";
	if(User::find_by_sql($sqlName)){
		$session->message("<font color='#FF0000'>Not Added</font> :: name already exists");
		pageRedirect();
	}	
	
	$users = new User();
	
	$users->active = ($_POST['active'] == "on" ? 1 : 0);
	
	$users->user_name = $_POST['user_name'];
	$users->password = $_POST['password'];
	$users->first_name = $_POST['first_name'];
	$users->last_name = $_POST['last_name'];
	$users->user_type = $_POST['user_type'];
	$users->email = $_POST['email'];
	$users->phone = $_POST['phone'];
	$users->notes = $_POST['notes'];
	

	
	if($users->save()) {
		// Success
		$session->message("New user added successfully. ");
		
	} else {
		// Failure
		$session->message("<span style='color:#FF0000; font-weight:bold;'>Not able to add new user.</span>");
	}	


}else if($_POST['action'] == "update"){
	
	// error chedking
	$POST_user_name = trim($_POST['user_name' . $_POST['id']]);
	
	if($POST_user_name == ""){
		$session->message("<font color='#FF0000'>Not Updated</font> :: User Name Required");
		pageRedirect();
	}	
	
	// check if name already exsists
	$sqlName = "SELECT * FROM casl_users WHERE user_name='{$POST_user_name}' AND id != " . $database->escape_value($_POST['id']) . " LIMIT 1";
	if(User::find_by_sql($sqlName)){
		$session->message("<font color='#FF0000'>Not updated</font> :: duplicate name");
		pageRedirect();
	}		
	$users = User::find_by_id($_POST['id']);
	
	$users->active = ($_POST['active' . $_POST['id']] == "on" ? 1 : 0);
	
	$users->user_name = $_POST['user_name' . $_POST['id']];
	$users->password = $_POST['password' . $_POST['id']];
	$users->first_name = $_POST['first_name' . $_POST['id']];
	$users->last_name = $_POST['last_name' . $_POST['id']];
	$users->user_type = $_POST['user_type' . $_POST['id']];
	$users->email = $_POST['email' . $_POST['id']];
	$users->phone = $_POST['phone' . $_POST['id']];
	$users->notes = $_POST['notes' . $_POST['id']];

	
	$users->save();
	
	$session->message("User updated " . $_POST['user_name' . $_POST['id']] . " " . $_POST['id']);
	
}else if($_POST['action'] == "delete"){
	  $users = User::find_by_id($_POST['id']);
	  if($users && $users->delete()) {
		$session->message("User deleted - " . $_POST['user_name']);
	  } else {
		$session->message("User could not be deleted.");
	  }		
}

pageRedirect();

?>


<?php if(isset($database)) { $database->close_connection(); } ?>
