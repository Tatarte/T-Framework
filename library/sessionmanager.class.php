<?php 
class Library_SessionManager {  //Manages the session
    
	#private ;
	
	function __construct() { 
		
	}
	
	public function inSession($name)
	{
		$this->start();
		return isset($_SESSION[$name]);
	}
	
	public function get($name)
	{
		if ($this->inSession($name))
		{
			return $_SESSION[$name];
		}else
		{
			throw new Exception("Failed to get $name in session");
		}
	}
	
	public function set($name,$value)
	{
		$this->start();
		 $_SESSION[$name]=$value;
	}
	
	private function start()
	{
		if(session_status() == PHP_SESSION_NONE) 
		{
			session_start();
		}
	}
} 

?> 