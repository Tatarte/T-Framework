<?php 
class Library_Request {  //Management of an HTTP request
    private $data;                   // To host query parameters
	private $method;
	private $site;			//Site level of the URL
	private $controller;	//Controller level of the URL
	private $action;		//Action level of the URL
	private $errors = array();       // To host any error message after parameters validation (To be replaced by throwing Exceptions?)
	private $successes = array();    // To host any feedback message successful request
    
    function __construct() {
		$this->method=$_SERVER['REQUEST_METHOD'];
		$parse=parse_url($_SERVER['REQUEST_URI']);
		$parsed=explode('/',$parse['path']);
		$this->site=$parsed[1];
		$this->controller=$parsed[2];
		if(isset($parsed[3]))
		{
			$this->action=$parsed[3];
		}
		if(isset($parsed[4])AND isset($parsed[5]))
		{
			$this->data[$parsed[4]]=$parsed[5]; // 2 last URL levels past action are param&value
		}
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
		return $this->site."/". $this->controller; //need to add fullpath
	}
	public function getController()
	{
		return (isset($this->controller) ? $this->controller :FALSE );
	}
	public function getAction()
	{
		return (isset($this->action) ?$this->action :null );
	}
	public function setError($name,$value)  //see comment on class declaration
	{
		$this->errors[$name]=$value;
	}
	public function setSuccess($name,$value)
	{
		$this->successes[$name]=$value;
	}
	public function validate($param,$type,$notNull=true)
	{
		if (isset($this->data[$param]) AND !empty($this->data[$param]))
		{
			switch($type)
			{
				case "int":
					if (!filter_var($this->data[$param],FILTER_VALIDATE_INT))
					{
						 throw new Exception("Request Parameter ($param) is not an integer");
					}
				break;
				case "date":
					if (!DateTime::createFromFormat('Y-m-d', $this->data[$param]))  //Should I be able to change the date format??
					{
						 throw new Exception("Request Parameter ($param) is not an 'Y-m-d' formatted date");
					}else
					{
						 $temp = explode('-',$this->data[$param]);
						 if (!checkdate($temp[1],$temp[2],$temp[0]))
						 {
							throw new Exception("Request Parameter ($param) is not a valid date");
						 }
					}
				break;
				case "email":
					if (!filter_var($this->data[$param],FILTER_VALIDATE_EMAIL))
					{
						 throw new Exception("Request Parameter ($param) is not an email");
					}
				break;
				case "url":
					if (!filter_var($this->data[$param],FILTER_VALIDATE_URL))
					{
						 throw new Exception("Request Parameter ($param) is not an url");
					}
				break;
			}
		}
	}
} 

?> 