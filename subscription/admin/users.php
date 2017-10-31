<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}


// Find all user types
$userTypes = UserTypes::find_all();


function makeUserTypeDropDown($userid, $suertypeid){
	$flag_bol = true;
	global $userTypes;
	
	if($userid == 0){
		echo '<SELECT NAME="user_type">';
	}else{
		echo '<SELECT NAME="user_type' .$userid . '">';
	}
	
	
	foreach($userTypes as $type): 
		$sle = "";
		if($type->id == $suertypeid ){
			$sle = 'selected="selected"';
		}
		
		if($suertypeid == 0 && $flag_bol){
			$flag_bol = false;
			$sle = 'selected="selected"';
		}
		echo '<OPTION VALUE="' . $type->id. '" ' . $sle . '>' . $type->type . "</OPTION>"; 
	endforeach;
	echo '</SELECT>';
	
	
}


// Find all the users
$users = User::find_all();

$count = 1;
  
require_once('_admin_header.php');


?>

<h1>User Administration</h1>

<script language="javascript" type="text/javascript">
/* <![CDATA[ */

function confirmDelete() {
	if (confirm("Do you really want to delete this record?")) {
		return true;
	} else {
		return false;
	}
} 

function confirmClearLockedLots() {
	if (confirm("Do you really want to clear all locked lots?")) {
		return true;
	} else {
		return false;
	}
} 

function subupdate(id){
	document.mainform.id.value = id;
	document.mainform.action.value = "update";
	document.mainform.submit();
}
function subdelete(id){
		
	if(!confirmDelete()){
		return;
	}
	
	document.mainform.id.value = id;
	document.mainform.action.value = "delete";
	document.mainform.submit();
}




function subnew(id){
	document.mainform.action.value = "addnew";
	document.mainform.submit();
}

$(function() {
		
	$( "#accordion" ).accordion();
	
	
	$("#mainform").validate();
});	






/* ]]> */
</script>

<form name="mainform" id="mainform" method="post" action="users_action.php">
    <input type="hidden" name="action" value="xx" />
    <input type="hidden" name="id" value="xx" />
    
    
    

    
<div id="accordion">
	
    
    <h3><a href="#">Add New User</a></h3>
	<div>
                
        <table class="bordered" width="100%">
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Type</th>
            <th>Active</th>
          </tr>
        
        
          <tr>
            
            <td><input type="text" value="" name="user_name" size="10" class="required"/>   <?php requiredStar(); ?></td>
            <td><input type="text" value="" name="password"  size="10" class="required"/>   <?php requiredStar(); ?></td>
        
            <td><?php makeUserTypeDropDown(0, 0); ?></td>
            <td><input type="checkbox" name="active" id="enable" checked="yes"  /></td>
        
          
          </tr>
          <tr>
            
            <td colspan="4">
            <div>
                <table width="100%" class="talbeProductsEdit">
                    <tr>
                        <td width="175">First Name</td>
                        <td><input type="text" value="" name="first_name" size="20" /></td>
                    </tr>
                    <tr>
                        <td width="175">Last Name</td>
                        <td><input type="text" value="" name="last_name"  size="20"/></td>
                    </tr>
                    <tr>
                        <td width="175">Email</td>
                        <td><input type="text" value="" name="email"  size="20"/></td>
                    </tr>
                    <tr>
                        <td width="175">Phone</td>
                        <td><input type="text" value="" name="phone"  size="20"/></td>
                    </tr>
                    
                    <tr>
                        <td width="175">Notes</td>
                        <td><textarea name="notes" rows="5" cols="50"></textarea></td>
                    </tr>
                </table>		    
            </div>
           </td>
          </tr>
          <tr>
          	<td colspan="4"><input type="button" value="Add New" onclick="subnew()" /></td>
          </tr>  
           
        </table>
        
    </div>
    
        

 
<?php foreach($users as $user): ?>
    <h3><a href="#">Update: <?php echo $user->user_name; ?></a></h3>
	<div>

        <table class="bordered" width="100%">
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Type</th>
            <th>Active</th>
            
            
          </tr>
        
        
          <tr>
            <td><input type="text" value="<?php echo $user->user_name; ?>" name="user_name<?php echo $user->id; ?>" size="10" /> <?php requiredStar(); ?></td>
            <td><input type="text" value="<?php echo $user->password; ?>" name="password<?php echo $user->id; ?>"  size="10"/> <?php requiredStar(); ?></td>
            <td><?php makeUserTypeDropDown($user->id, $user->user_type); ?></td>
            <td><input type="checkbox" name="active<?php echo $user->id; ?>" id="enable<?php echo $user->id; ?>" 
                            <?php echo ($user->active == 1 ? 'checked="yes"' : ''); ?>  /></td>
        
          </tr>
          <tr>
            <td></td>
            <td colspan="4">
            
                <table width="100%" class="talbeProductsEdit">
                    <tr>
                        <td width="175">First Name</td>
                        <td><input type="text" value="<?php echo $user->first_name; ?>" name="first_name<?php echo $user->id; ?>" size="20" /></td>
                    </tr>
                    <tr>
                        <td width="175">Last Name</td>
                        <td><input type="text" value="<?php echo $user->last_name; ?>" name="last_name<?php echo $user->id; ?>"  size="20"/></td>
                    </tr>
                    <tr>
                        <td width="175">Email</td>
                        <td><input type="text" value="<?php echo $user->email; ?>" name="email<?php echo $user->id; ?>"  size="20"/></td>
                    </tr>
                    <tr>
                        <td width="175">Phone</td>
                        <td><input type="text" value="<?php echo $user->phone; ?>" name="phone<?php echo $user->id; ?>"  size="20"/></td>
                    </tr>
                    <tr>
                        <td width="175">Notes</td>
                        <td><textarea name="notes<?php echo $user->id; ?>" rows="5" cols="50"><?php echo $user->notes; ?></textarea></td>
                    </tr>
                </table>		    
            
           </td>
           </tr> 
          <tr>
          	<td colspan="4"><input type="button" value="Update" onclick="subupdate('<?php echo $user->id; ?>')" /> 
                <input type="button" value="Delete" onclick="subdelete('<?php echo $user->id; ?>')" /></td>
          </tr>
        </table>
	</div>
    
<?php endforeach; ?>

  
  

</form>
<br />

</div>
  
    
<?php

require_once('_admin_footer.php');

?>