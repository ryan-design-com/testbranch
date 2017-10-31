<?php
require_once('includes/initialize.php');

if($session->is_logged_in()){
	redirect_to("index.php");
}

// check if table exsites

if( isset($_POST['submit'])){
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	$found_user = User::authenticate($username, $password);
	//$found_user = User::authenticate_admin($username, $password);
	
	if($found_user){
		$session->login($found_user);
		$session->message("Welcome " . $found_user->first_name . " " . $found_user->last_name);
		redirect_to("index.php");
	}else{
		$message = "<span style='color:#FF0000; font-weight:bold;'>Username and or password does not match</span>";
		$session->message = $message;
	}
} else {
	$username = "";
	$password = "";

}

require_once('_admin_header.php');

if (!checkIfTalbeExsists("casl_user_types")){
	// create table casl_user_types
	//echo "creating casl_user_types <br>";
	
	$createTableQuery = "CREATE TABLE casl_user_types (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;";
	
	if(mysql_query($createTableQuery)){
		//echo "sucesss <br>";
		
		$insertQuery = "INSERT INTO casl_user_types (`id`, `type`, `description`) VALUES
(1, 'Super Admin', ''),
(2, 'Admin', ''),
(3, 'Manager', ''),
(4, 'Sales Person', ''),
(5, 'Realtor', '');";
		if(mysql_query($insertQuery)){
			//echo "insert sucesss <br>";
		}else{
			//echo "insert failed <br>";
		}
	}else{
		//echo "failed <br>";
	}
				
}

if (!checkIfTalbeExsists("casl_users")){
	// create table casl_users
	
	$createTableQuery = "CREATE TABLE `casl_users` (
		`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`user_name` varchar(25) NOT NULL,
		`password` varchar(25) NOT NULL,
		`first_name` varchar(25) NOT NULL,
		`last_name` varchar(25) NOT NULL,
		`user_type` int(11) DEFAULT NULL,
		`email` varchar(50) NOT NULL,
		`phone` varchar(20) NOT NULL,
		`active` int(11) NOT NULL,
		`notes` tinyblob NOT NULL,
		PRIMARY KEY (`id`),
		KEY `user_type` (`user_type`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ";

	if(mysql_query($createTableQuery)){
		//echo "sucesss <br>";
		
		$insertQuery = "INSERT INTO `casl_users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `user_type`, `email`, `phone`, `active`, `notes`) VALUES
(1, 'admin', '567892', 'rob', 'pandher', 1, '', '', 1, 0x61647366);";
		if(mysql_query($insertQuery)){
			//echo "insert sucesss <br>";
		}else{
			//echo "insert failed <br>";
		}
	}else{
		//echo "failed <br>";
	}
	
}

if (!checkIfTalbeExsists("casl_register_forms")){
	// create table casl_register_forms
	
	$createTableQuery = "CREATE TABLE `casl_register_forms` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(200) NOT NULL,
		`form_table_name` varchar(250) NOT NULL DEFAULT '',
		`active` int(11) NOT NULL DEFAULT '0',
		`notes` tinyblob NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

	if(mysql_query($createTableQuery)){
		//echo "sucesss <br>";
	}else{
		//echo "failed <br>";
	}	
}


?>


    <div id="main" style="height:600px;">
		<h1>Staff Login</h1>
		<?php //secho output_message($message); ?>

		<form action="login.php" method="post">
		  <table width="500" style="padding-top:50px;">
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
		    <tr>
		      <td align="right">Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td align="right">Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
		    <tr>
            	<td>&nbsp;</td>
		      <td align="lef">
		        <input type="submit" name="submit" value="Login"   class="contentTopButton"/>
		      </td>
		    </tr>
		  </table>
		</form>
    </div>
    


<?php

require_once('_admin_footer.php');

?>

