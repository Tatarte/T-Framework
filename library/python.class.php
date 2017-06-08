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
		exec($this->path.$script." ".$params,$result);

		return $result;
	}
	
} 

?> 