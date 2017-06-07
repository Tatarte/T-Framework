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
		if($this->action=="api")  // API example
		{
			$json = new Library_json(array("data"=>1,"test"=>"success"));
			$json->send();
		}
		$view = new Model_View;
		if($this->action=="mysql")  // Mysql example
		{
			try{
			$db=new Library_MySQLDB($GLOBALS['config']->xml->database->host,$GLOBALS['config']->xml->database->user,$GLOBALS['config']->xml->database->password,$GLOBALS['config']->xml->database->db); //get the config from config file
			} catch (Exception $e){
				$view->assign("error",$e->getMessage());
			}
			if ($request->getData('id'))
			{
				$view->assign("data",$db->simpleQuery("SELECT * FROM test WHERE id=?",array('i'=>$request->getData('id'))));
			}else
			{
				$view->assign("data",$db->simpleQuery("SELECT * FROM test"));  //Make only one call with different filters
			} 
		}
		
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