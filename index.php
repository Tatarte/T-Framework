<?php
$timeStart=microtime(TRUE);  //Register the start of execution to display execution time
spl_autoload_register(function($class) { return spl_autoload(str_replace('_', DIRECTORY_SEPARATOR, $class.".class"));});
try
{	
 	$GLOBALS['config'] = new Library_Configuration(getcwd().DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.xml");	 //Get config object from xml default file.
}catch (Exception $e)
{
		die($e->getMessage()); //can't load the site if config is not loaded
}
#$log = new Library_logger($GLOBALS['config']->xml->logfile); // start logs
$request = new Library_Request;	 //new Request management object
$class = (!$request->getController()) ? "Controller_Home": "Controller_".ucwords($request->getController());  // Selecting the controller from 1st item on path following the site root
if (!class_exists($class))
{
	die('This section does not exist on the site');
}else{
#$log->log("TEST");
$controller= new $class($request->getAction(),$timeStart); 
$controller->run($request);
}
?>
