<?php 
class Library_Python {  //Manages Python scripts
    
	private $path;
	private $result; //?necessary?
	
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
		
		$process = popen($this->path.$script." ".$params,"r"); 

		while($line = fgets($process, 2048))
		{
			if ($line[0]=='#')
			{
				$this->result=json_decode(trim($line,"#"));
			}else{
			echo $line."<br>\n"; 
			ob_flush();flush(); 
			} 
		}
		pclose($process); 
	}
	
} 

?> 