<?php
require_once('includes/initialize.php');


if(!$session->is_logged_in()){
	redirect_to("login.php");
}


function errorRedirect($errorMessage = ""){
	global $session;
	$session->message($errorMessage);
	redirect_to("registrants.php");
}








//echo "<br>$where_from = " . $where_from. "<br>";


$fp = fopen('php://output', 'w');



if ($fp) {

	$currentTableName = $_REQUEST["tbl"];
	$currentName = $_REQUEST["name"];
	
	//$sqlRegistrants = "SELECT * FROM  bas_registrants $whereClause ORDER BY id $limit";
	$sqlRegistrants = "SELECT * FROM  $currentTableName ORDER BY id $limit";
	
	
	$result_sqlRegistrants = $database->query($sqlRegistrants);
	
	$numfields = mysql_num_fields($result_sqlRegistrants);
	
	$feildArray;
	
	for ($i=0; $i < $numfields; $i++) // Header
	{ 
	
		$myFieldName = mysql_field_name($result_sqlRegistrants, $i);
		$myFieldName = str_replace("_", " " , $myFieldName);
		$myFieldName = ucwords($myFieldName);
		$headers[] = $myFieldName;
		//echo '<th>'.mysql_field_name($result_sqlRegistrants, $i).'</th>'; 
	}
	
		
	

	
	
	$fileName = "registrants_" . $_GET["tbl"] . "_" . mktime() . ".csv";
	
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName. '"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
		
	$csv_output = "";
		
		
	while ($row = mysql_fetch_row($result_sqlRegistrants)) // Data
	{ 
	
		$currentRowArray = array();
		//echo '<tr><td>'.implode($row,'</td><td>')."</td></tr>\n"; 
		for ($i=0; $i < $numfields; $i++){
			//echo $feildArray[$i] . " : ". $row[$i];
			//echo "<br />";
			
			$currentRowArray[] = $row[$i];
			
		}
		
		$rowArray = $currentRowArray;
		
		
		fputcsv($fp, $rowArray);
		
	}
	
	/*
	//echo "<table>";
	while ($row = mysql_fetch_assoc($result_set_reportSQL)) {
		
	
		
			$rowArray = array(	$row['time_created'], 
								$row['first_name'] , 
								$row['last_name'] , 
								$row['email'] , 
								$row['phone_home'] , 
								$row['phone_cell'] , 
								$row['home_address1'] , 
								$row['home_city'] , 
								$row['home_state'] , 
								$row['home_zip'] , 
								$row['hear_from'] , 
								$row['comments'] , 
								$row['notes'] ); 
		
		
			fputcsv($fp, $rowArray);

	}
	*/
	//echo "</table>";

    if(isset($database)) { $database->close_connection(); }
	
    die;
}

if(isset($database)) { $database->close_connection(); }






?>

