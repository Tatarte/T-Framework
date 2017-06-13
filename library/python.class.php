<?php 
class Library_Python {  //Manages Python scripts
    
	private $path;
	
	function __construct() { 
		$this->path=SERVER_ROOT.DIRECTORY_SEPARATOR."scripts".DIRECTORY_SEPARATOR;
	}

	public function run($script,$args) //Add args format
	{	
		$params="";
		foreach($args as $key=>$value)
		{
			$params.="$key $value";
		}		
		
		$a = popen($this->path.$script." ".$params,"r"); 

		while($b = fgets($a, 2048)) { 
		echo $b."<br>\n"; 
		ob_flush();flush(); 
		} 
		pclose($a); 
		
	}
	
} 

?> 