<?php 
class Model_View { 

/*
*	Class handling the pages display
*	
*
*/
	private $data = array();  // Holds the data needed to support the display
	
	public function assign($name,$value) 
	{
		$this->data[$name]=$value;  
	}
	
	public function render($string)  // Pages to render are managed by Controller and action in the file system . However it's always possible to have general diplay pages like headers and footers.
	{
		$parse=explode("_",$string);
		$file=end($parse);
		array_pop($parse);
		$path="";
		foreach($parse as $folder)
		{
			$path.=$folder.DIRECTORY_SEPARATOR;
		}
		include("G:".DIRECTORY_SEPARATOR."T".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."$path$file.php");
	}
} 

?> 