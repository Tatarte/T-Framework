<?php
spl_autoload_register(function($class) { return spl_autoload(str_replace('_', DIRECTORY_SEPARATOR, $class.".class"));});
	
$request = new Library_Request;

$tree=explode('/',$request->getPath());  
array_shift($tree);
array_shift($tree);
$class= ($tree[0]=="") ? "Controller_Home": "Controller_".ucwords($tree[0]);  // Selecting the controller from 1st item on path following the site root
if (isset($tree[1]))
{
	$action=$tree[1]; 														// Requesting a certain behavior from the controller based on 2nd path item
}else
{
	$action=null;
}

$controller= new $class($action,microtime(TRUE));
$controller->run($request);
?>
