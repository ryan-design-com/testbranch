<?php
// validate form

error_reporting(0);

if($_REQUEST["middle_name"] == "" && $_REQUEST["fax_number"] == "416.661.7866"){


if ($_POST['first_name']=="" ) 
{ echo "Required fields must be entered, hit back button and re-enter information"; } 

else {



// connect to database
include 'config.php';

//Local variables
$table =  "soon_hillandale";
$template = 'notification.html'; // notification
//$template2 = '../EMAILER/Z011156-2015-05-29/index.html'; // autoresponder
$site = "Coming Soon Hillandale Registrants"; // Site Name
$FROM = "info@pmcommunities.com"; // address From
$TO = 'mikem@ryan-design.com'; // Notifications send To
//$TO = 'mikem@ryan-design.com, oskrunts@ryan-design.com'; // Notifications send To
$redirect = "/thanks.php";

//Get data into array


        $allArray = array(
            array(
                "data" => $_POST["first_name"],
                "field" => "first_name",
                "title" => "First Name"),
            array(
                "data" => $_POST["last_name"],
                "field" => " last_name",
                "title" => "Last Name"),
            array(
                "data" => $_POST["email"],
                "field" => " email",
                "title" => "Email Address"),
  
            array(
                "data" => $_POST["phone"],
                "field" => " phone",
                "title" => "Telephone"),
				
		 	array(
                "data" => $_POST["address"],
                "field" => " address",
                "title" => "address"),
				
			array(
                "data" => $_POST["city"],
                "field" => " city",
                "title" => "city"),
				
			array(
                "data" => $_POST["state"],
                "field" => " state",
                "title" => "state"),
				
			array(
                "data" => $_POST["zip"],
                "field" => " zip",
                "title" => "zip"),
				
            array(
                "data" => $_POST["rent_or_own"],
                "field" => " rent_or_own",
                "title" => "rent_or_own"),
				
			array(
                "data" => $_POST["home_type"],
                "field" => " home_type",
                "title" => "home_type"),

            array(
                "data" => $_POST["time_frame"],
                "field" => " time_frame",
                "title" => "time_frame"),
				
			array(
                "data" => $_POST["how_did_you_hear"],
                "field" => " how_did_you_hear",
                "title" => "how_did_you_hear"),
				
			array(
                "data" => $_POST["number_of_bedrooms"],
                "field" => " number_of_bedrooms",
                "title" => "number_of_bedrooms"),
				
			array(
                "data" => $_POST["number_of_bathrooms"],
                "field" => " number_of_bathrooms",
                "title" => "number_of_bathrooms"),
				
			array(
                "data" => $_POST["price_point"],
                "field" => " price_point",
                "title" => "price_point"),

                       array(
                "data" => $_POST["comments"],
                "field" => " comments",
                "title" => "comments"),
        );


$max =  count($allArray);

 

	// Construct query string
	$query = "insert into " . $table . "(";
	
	for($i = 0; $i < $max; $i++){
		$query .= $allArray[$i]["field"] . ", ";
	}
	
	$query = substr($query, 0, -2) . ") values('";
	
	for($i = 0; $i < $max; $i++){
		$query .= $allArray[$i]["data"] . "', '";
	}
	
	$query = substr($query, 0, -3) . ")";


	
	mysql_query($query)  or die(mysql_error());
			
			
	// Send form date to email
	$fd = fopen($template,"r");
	
	$time = date("M d Y",time());
	
	$SUBJECT = "E-Notification: New Registration at ".$site;
	
	$HEADER = 'MIME-Version: 1.0' . "\r\n";
	$HEADER .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$HEADER .= "From: $FROM";
	$MESSAGE = fread($fd, filesize($template));
			
	$fields = "<tr><td align='right' class='field'>Date Received:</td>\n";
	$fields .= "<td align='left' class='value'>" . $time . "</td></tr>\n";
	
	for($i = 0; $i < $max; $i++){
		$fields .= "<tr><td align='right' class='field'>" .$allArray[$i]["title"] . ": </td>\n";
		$fields .= "<td align='left' class='value'>" .$allArray[$i]["data"] . "</td></tr>\n";
	}
	
	$original = array("{site_name}", "{tbody}");
	$replace = array($site,  $fields);
	
	
	$MESSAGE = str_replace($original,$replace, $MESSAGE);

	mail($TO,$SUBJECT,$MESSAGE,$HEADER);
	fclose($fd);
		
	
header("Location: /thanks.php");
exit();

}
}
else
 {
header("Location: /thanks.php"); 
exit();
}

?>