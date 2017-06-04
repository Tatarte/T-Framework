<?php 
class Library_Configuration {  //Reads the app configuration settings
    
	private $xml;
	
    function __construct($configFile) {
		if(file_exists($configFile))
		{
			$this->xml=simplexml_load_file($configFile);
			define("APP", $this->xml->name);  //SET some global constants
			define("VERSION", $this->xml->version);
			define("AUTHOR", $this->xml->author);
			define("YEAR", $this->xml->year);
			define("SITE_ROOT", $this->xml->url);
			define("SERVER_ROOT", $this->xml->server);
		}else
		{
			throw new Exception("CRITICAL ERROR [Couldn't initialize App settings]");
		}

	}
	
} 

?> 