<?php 
class Library_Request {  //Management of an HTTP request
    private $path; 
    private $data;                   // To host query parameters
	private $method;
	private $errors = array();       // To host any error message after parameters validation
	private $successes = array();    // To host any feedback message successful request
    
    function __construct() {
		$this->method=$_SERVER['REQUEST_METHOD'];
		$parse=parse_url($_SERVER['REQUEST_URI']);
		$this->path=$parse['path'];
		switch($this->method)        //Retreiving parameters for either _GET or _POST
		{
		case 'GET': $var = &$_GET; break;
		case 'POST': $var = &$_POST; break;
		}	
		foreach($var as $param=>$value)
		{
			$this->data[$param]=$value;
		}
	}
	
	public function getData($name)  
	{
		return isset($this->data[$name]) ? $this->data[$name] : FALSE ;
	}
	public function getPath()
	{
		return $this->path;
	}
	public function setError($name,$value)
	{
		$this->errors[$name]=$value;
	}
	public function setSuccess($name,$value)
	{
		$this->successes[$name]=$value;
	}
} 

?> 