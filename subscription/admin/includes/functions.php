<?php

function gDebugMessageText($passMessage){
	global $appDebugText;
	
	if(APP_DEBUG_OPTION){
		$appDebugText = $appDebugText . "<br>" . $passMessage;
	}
	
}

function gPrintDebugMessageText(){
	global $appDebugText;
	
	if(APP_DEBUG_OPTION){
		echo "<br><hr><div style='color:#930; text-align: left; padding: 50px;'>";
		
		echo $appDebugText;
		
		echo "</div><hr><br><br>";
		
	}
	
}



function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function checkCurrentPage($passCompareStr){
	global $current_page_id;
	$returnValue = "";
	if($current_page_id == $passCompareStr){
		echo 'class="selected"';
	}
}

function checkCurrentPageProductDetail($passCompareStr, $passCompareId){
	global $current_page_id;
	$returnValue = "";
	if($current_page_id == $passCompareStr && $passCompareId == $_GET["id"]){
		echo 'class="selected"';
	}
}


/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
	
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }

   }
   return $isValid;
}


/* date functions */


function convert_unixtime_to_beginingof_day($passMktime){
	
	return mktime(0, 0, 0, date("m", $passMktime), date("d", $passMktime), date("Y", $passMktime));
	
	
	//mktime(h, m, s, month, day, year);	
}


function requiredStar(){
	echo '<span style="color:#FF0000; font-weight:bold">*</span>';	
}



function commonGetTicketFileTemplate(){
	return file_get_contents('../templates/emailer/ticket.html', FILE_USE_INCLUDE_PATH);	
}


function commonGetRemiderTicketFileTemplate(){
	return file_get_contents('../templates/emailer/reminder.html', FILE_USE_INCLUDE_PATH);	
}



function commonGenrateCode($codeLength = 4 ){
	
	// upper case
	$charArray[] = "A";
	$charArray[] = "B";
	$charArray[] = "C";
	$charArray[] = "D";
	$charArray[] = "E";
	$charArray[] = "F";
	$charArray[] = "G";
	$charArray[] = "H";
	$charArray[] = "I";
	$charArray[] = "J";
	$charArray[] = "K";
	$charArray[] = "L";
	$charArray[] = "M";
	$charArray[] = "N";
	$charArray[] = "O";
	$charArray[] = "P";
	$charArray[] = "Q";
	$charArray[] = "R";
	$charArray[] = "S";
	$charArray[] = "T";
	$charArray[] = "U";
	$charArray[] = "V";
	$charArray[] = "W";
	$charArray[] = "X";
	$charArray[] = "Y";
	$charArray[] = "Z";
	
	
	
	// numbers
	$charArray[] = "0";
	$charArray[] = "1";
	$charArray[] = "2";
	$charArray[] = "3";
	$charArray[] = "4";
	$charArray[] = "5";
	$charArray[] = "6";
	$charArray[] = "7";
	$charArray[] = "8";
	$charArray[] = "9";	

			
	$totalCharToChoseFrom = count($charArray);
	
	//echo $totalCharToChoseFrom . "<br>";
	
	$randMin = 0;
	$randMax = $totalCharToChoseFrom - 1;	
	
	$newCode = "";
	
	for($j = 0; $j < $codeLength; $j++){
		$randPosition = rand($randMin, $randMax);
		
		$newCode = $newCode . $charArray[$randPosition];
		
	}
	
	return strtolower($newCode);
	
}

function commonFixName($passName){
	return preg_replace("/[^a-zA-Z0-9âùæçéèêëîïôœùûüÜÛÙŒÔÏÎËÊÈÉÇÆÄÂÀ' \s]/", "", $passName);	
}

function commonFixPhone($passPhone){
	return preg_replace("/[^0-9- \s]/", "", $passPhone);	
}

function commonFixPhoneWithoutSpace($passPhone){
	return preg_replace("/[^0-9]/", "", $passPhone);	
}




function getDirectory( $path = '.', $level = 0 ){
	
	
	// Directories to ignore when listing output.
	$ignore = array( '.', '..' );
	
	// Open the directory to the handle $dh
	$dh = @opendir( $path );
	
	// Loop through the directory
	while( false !== ( $file = readdir( $dh ) ) )
	{
		// Check that this file is not to be ignored
		if( !in_array( $file, $ignore ) )
		{
			// Indent spacing for better view
			$spaces = str_repeat( '&nbsp;', ( $level * 5 ) );
		
			// Show directories only
			if(is_dir( "$path/$file" ) )
			{
				// Re-call this same function but on a new directory.
				// this is what makes function recursive.
				//echo "$spaces<a href='$path/$file/index.php'>$file</a><br />";
				//getDirectory( "$path/$file", ($level+1) );
				
				if($file != "admin"){
					$returnArray[] = $file;
				}
				
			}
		}
	}
	// Close the directory handle
	closedir( $dh );
	
	return $returnArray;
} 



function checkIfTalbeExsists($tableName){
	 global $database;
		
	$currenQuery = 'SELECT 1 FROM ' . $tableName . ';';
			
	$val = mysql_query($currenQuery);
	
	if($val !== FALSE)
	{
	   return true;
	}
	
	return false;

}

?>