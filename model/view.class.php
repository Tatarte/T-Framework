<?php 
class Model_View { 
	
	private $data = array();
	
	public function assign($name,$value)
	{
		$this->data[$name]=$value;
	}
	
	public function render($string)
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