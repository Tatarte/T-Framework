<?php 
class Library_json {  //Manages the json response for API
    
	private $data;
	private $success;
	
	function __construct($data,$success=TRUE) { 
		$this->data = $data;
		$this->success = $success;
	}
	
	public function send()
	{
		header('Content-type: application/json');
		echo json_encode(array("success"=>$this->success,"data"=>$this->data));
		die();
	}
	
/*	public function success() //necessary?
	{
		$this->success = TRUE;
	}
	public function failed()
	{
		$this->success = FALSE; 
	}*/

} 

?> 