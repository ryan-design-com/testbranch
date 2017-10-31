<?php

class Email{

	public $from;
	public $to;
	public $bcc;
	public $title;
	public $message;
	
	private $headers;
	
	public function sendEmail(){
		if(empty($this->from) || empty($this->to) || empty($this->title) || empty($this->message)){
			return false;
		}
	
		$this->buildHeaders();
	   	ini_set("SMTP","localhost");  
	
	   	if(mail($this->to,$this->title,$this->message,$this->headers)) 
			return true; 
	   	else 
		  	return false; 		
	}

	protected function buildHeaders(){
		$this->headers  = "MIME-Version: 1.0\r\n";
		$this->headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		
		$this->headers .= "From: " . $this->from . "\r\n";
		if(!empty($this->bcc)){
			$this->headers .= 'Bcc: ' . $this->bcc . "\r\n";
		}	
	}
}

?>