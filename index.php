<?php
$timeStart=microtime(TRUE);  //Register the start of execution to display execution time

if (isset($_SERVER['HTTP_USER_AGENT']) &&     (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) // Exclude IE users  |||To move to Config?
{
	die("<h5>This website doesn't support IE.<br/>Treat yourself, and use a better <a href='https://www.google.ca/chrome/browser/features.html'>browser.</a></h5>");
}

spl_autoload_register(function($class) { return spl_autoload(str_replace('_', DIRECTORY_SEPARATOR, $class.".class"));});  // Autoloader
try
{	
 	$GLOBALS['config'] = new Library_Configuration(getcwd().DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.xml");	 //Get config object from xml default file.
}catch (Exception $e)
{
		die($e->getMessage()); //can't load the site if config is not loaded
}
$GLOBALS['session'] = new Library_SessionManager(); // Set the session manager in globals

if (!$GLOBALS['session']->inSession('user')) //check if user logged in
{
	//log in mechanic
	$user = new Model_user("test","test","test.jpg","test@test.com","admin");
	$user->loginIn();
}
try 
{
	if ($GLOBALS['session']->get('user')->getLevel()=='Denied') //check session security http://phpsec.org/projects/guide/4.html
	{
		die ("You are not authorized");
	}
}
catch (Exception $e)
{
	die ("couldn't verify login");
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
