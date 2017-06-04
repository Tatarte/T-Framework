<?php 
class Controller_Examples { 

/*
*	Controller to manage the examples for T-Framework
*
*/
	private $action;        // Allows the controller to follow a basic behavior based on requested path
	private $session;  		// Hosts current session manager object
	
	function __construct($action,$session) {
		(!isset($action)or empty($action)) ? $this->action="home" : $this->action=$action; //"Test" is default action behavior
		$this->session=$session;
	}
	
	public function run($request)
	{
		if($this->action=="mysql")
		{
			$db=new Library_MySQLDB("localhost","root","","test"); //get the config from config file
		}
		$view = new Model_View;
		$view->assign("action",$this->action);
		$view->assign("time",$this->session);
		$view->render("header");
		try{
			$view->render("examples_$this->action");
		} catch (Exception $e)
		{
			$view->assign("error",$e->getMessage());
			$view->render("home_test"); // In case of error in loading custom action page, loading default one with Message
		}
		$view->render("footer");
	}
} 

?> 