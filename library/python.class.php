<?php 
class Library_Python {  //Manages Python scripts
    
	#private ;
	
	function __construct() { 
		
	}

	public function run($script,$args) //Add args format
	{	
		$args="";
		foreach($args as $key=>$value)
		{
			$args.="$key $value";
		}
		passthru($script $args,$result)
	
		return $result;
	}
	
} 

?> 