<?php 
class Controller_Home { 
	
	private $action;        // Allows the controller to follow a basic behavior based on requested path
	private $session;  		// Hosts current session manager object
	
	function __construct($action,$session) {
		$this->action=$action;
		$this->session=$session;
	}
	
	public function run($request)
	{
		$view = new Model_View;
		$view->assign("action",$this->action);
		$view->assign("time",$this->session);
		$view->render("home_$this->action");
		$view->render("footer");
	}
} 

?> 