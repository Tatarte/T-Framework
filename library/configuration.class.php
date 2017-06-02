<?php 
class Library_Configuration {  //Reads the app configuration settings
    
	private $xml;
	
    function __construct() {
		
		$this->xml=simplexml_load_file(getcwd().DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.xml") or die("Error: Couldn't initialize App settings");
		define("APP", $this->xml->name);  //SET some global constants
		define("VERSION", $this->xml->version);
		define("SITE_ROOT", $this->xml->url);
		define("SERVER_ROOT", $this->xml->server);
	}
	
} 

?> 