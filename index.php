<?php
spl_autoload_register(function($class) { return spl_autoload(str_replace('_', DIRECTORY_SEPARATOR, $class.".class"));});
try
{	
 	$GLOBALS['config'] = new Library_Configuration(getcwd().DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.xml");	
}catch (Exception $e)
{
		die($e->getMessage());
}

$request = new Library_Request;	 //new Request management object
$class = (!$request->getController()) ? "Controller_Home": "Controller_".ucwords($request->getController());  // Selecting the controller from 1st item on path following the site root
$controller= new $class($request->getAction(),microtime(TRUE));  //Add exception handling here!
$controller->run($request);
?>
