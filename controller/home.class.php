<?php 
class Controller_Home { 

/*
*	Example of a default controller 
*	I'm using it right now for my debug activities
*
*/
	private $action;        // Allows the controller to follow a basic behavior based on requested path
	private $session;  		// Hosts current session manager object
	
	function __construct($action,$session) {
		(!isset($action)or empty($action)) ? $this->action="test" : $this->action=$action; //"Test" is default action behavior
		$this->session=$session;
	}
	
	public function run($request)
	{
		$view = new Model_View;
		if ($this->action=="test")
		{
			try
			{
				$request->validate("today","date");
				
			}catch (Exception $e)
			{
				$view->assign("error",$e->getMessage());
			}
		}
		
		$view->assign("action",$this->action);
		$view->assign("time",$this->session);
		$view->render("header");		
		try{
			$view->render("home_$this->action");
		} catch (Exception $e)
		{
			$view->assign("error",$e->getMessage());
			$view->render("home_test"); // In case of error in loading custom action page, loading default one with Message
		}
		$view->render("footer");
	}
} 

?> 