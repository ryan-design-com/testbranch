<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}



// Find all the users
$builder_accounts = RegisterForms::find_all();

$count = 1;
  
require_once('_admin_header.php');

echo "<br><h1>Exsisteing tables in the databse</h1>";
if($session->user_id == 1){ 

	// display all avaiable tables in the databse
	$sql = "SHOW TABLES FROM " .  DB_NAME;
	$result = mysql_query($sql);
	

	
	while ($row = mysql_fetch_row($result)) {
		echo "Table: {$row[0]}<br>";
	}

}

?>
<br>
<h1>Registration Tables Used</h1>

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

<form name="mainform" id="mainform" method="post" action="register_forms_action.php">
    <input type="hidden" name="action" value="xx" />
    <input type="hidden" name="id" value="xx" />
    
    
    

    
<div id="accordion">
	
    
    <h3><a href="#">Add New Registration Form</a></h3>
	<div>
                
        <table class="bordered" width="100%">

        
          <tr>
            
        
          
          </tr>
          <tr>
            
            <td colspan="4">
            <div>
                <table width="100%" class="talbeProductsEdit">
                    <tr>
                        <td width="175">Active</td>
               			<td><input type="checkbox" name="active" id="enable" checked="yes"  /></td>
                    </tr>
                    <tr>
                        <td width="175">Name</td>
                        <td><input type="text" value="" name="name" size="40" /></td>
                    </tr>
                    <tr>
                        <td width="175">Table Name</td>
                        <td><input type="text" value="" name="form_table_name"  size="80"/></td>
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
    
        

 
<?php foreach($builder_accounts as $builder_account): ?>
    <h3><a href="#">Update: <?php echo $builder_account->name; ?></a></h3>
	<div>

        <table class="bordered" width="100%">

          <tr>
            
            <td colspan="4">
            
                <table width="100%" class="talbeProductsEdit">
                    <tr>
                        <td width="175">Active</td>
               			<td>Active <input type="checkbox" name="active<?php echo $builder_account->id; ?>" id="active<?php echo $builder_account->id; ?>" 
                            <?php echo ($builder_account->active == 1 ? 'checked="yes"' : ''); ?>  /></td>
                    </tr>                
                    <tr>
                        <td width="175">Name</td>
                        <td><input type="text" value="<?php echo $builder_account->name; ?>" name="name<?php echo $builder_account->id; ?>" size="40" /></td>
                    </tr>
                    <tr>
                        <td width="175">Table Name</td>
                        <td><input type="text" value="<?php echo $builder_account->form_table_name; ?>" name="form_table_name<?php echo $builder_account->id; ?>" size="80" /></td>
                    </tr>

                    
                    <tr>
                        <td width="175">Notes</td>
                        <td><textarea name="notes<?php echo $builder_account->id; ?>" rows="5" cols="50"><?php echo $builder_account->notes; ?></textarea></td>
                    </tr>

                </table>		    
            
           </td>
           </tr> 
          <tr>
          	<td colspan="4"><input type="button" value="Update" onclick="subupdate('<?php echo $builder_account->id; ?>')" /> 
                <input type="button" value="Delete" onclick="subdelete('<?php echo $builder_account->id; ?>')" /></td>
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