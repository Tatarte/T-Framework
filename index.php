<?php
spl_autoload_register(function($class) { return spl_autoload(str_replace('_', DIRECTORY_SEPARATOR, $class.".class"));});
try
{	
	$config = new Library_Configuration(getcwd().DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.xml");	
}catch (Exception $e)
{
		die($e->getMessage());
}

$request = new Library_Request;	 //new Request management object
$tree=explode('/',$request->getPath());  
array_shift($tree);
array_shift($tree);
$class= ($tree[0]=="") ? "Controller_Home": "Controller_".ucwords($tree[0]);  // Selecting the controller from 1st item on path following the site root
if (isset($tree[1]))
{
	$action=$tree[1]; 	// Requesting a certain behavior from the controller based on 2nd path item
}else
{
	$action=null;
}
$controller= new $class($action,microtime(TRUE));
$controller->run($request);
?>
