<?php 
class Library_MySQLDB {  //Reads the app configuration settings
    
	private $mysqli;
	
    function __construct($host,$user,$password,$db,$port="3306") {
		$this->mysqli = new mysqli($host,$user,$password,$db,$port);
		if ($this->mysqli->connect_errno) {
			throw new Exception("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}

	}
	
} 

?> 