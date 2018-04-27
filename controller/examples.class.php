<?php 
class Controller_Examples { 

/*
*	Controller to manage the examples for T-Framework
*
*/
	private $action;        // Allows the controller to follow a basic behavior based on requested path
	private $session;  		// Hosts current session manager object
	
	function __construct($action,$session) {
		(!isset($action)or empty($action)) ? $this->action="home" : $this->action=$action; //"home" is default action behavior
		$this->session=$session;
	}
	
	public function run($request)
	{
		$view=null;
		if($this->action!="api") // API is not yet handled in the view class
		{
			$view = new Model_View;
		}
		
		$action=$this->action;
		$this->$action($request,$view);
		
		if($this->action!="api")
		{
			$view->assign("action",$this->action);
			$view->assign("time",$this->session);
			if($this->action!="python")
				$view->render("header");   //to put in Try
			
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
	
	protected function home($request,$view=null)
	{
		//do nothing for now
	}
	
	protected function api($request,$view=null)
	{
		$json = new Library_json(array("data"=>1,"test"=>"success"));
		$json->send();
	}
	
	protected function mysql($request,$view)
	{
		try{
			$db=new Library_MySQLDB($GLOBALS['config']->xml->database->host,$GLOBALS['config']->xml->database->user,$GLOBALS['config']->xml->database->password,$GLOBALS['config']->xml->database->db); //get the config from config file
		} catch (Exception $e){
			$request->setMsg("error","DataBase","Database couldn't be reached!");
		}
		if ($request->getData('id'))
		{
			$view->assign("data",$db->simpleQuery("SELECT * FROM test WHERE id=?",array('i'=>$request->getData('id'))));
		}else
		{
			$view->assign("data",$db->simpleQuery("SELECT * FROM test"));  //Make only one call with different filters
		} 
	}
	
	protected function python($request,$view)
	{
		$view->render("examples_pythonHeader");
		$python = new Library_python();
		$data=$python->run('hello.py',array());
		$view->assign('script',$data);	
	}
	
	protected function  usage($request,$view)
	{
		try{
			$db=new Library_MySQLDB($GLOBALS['config']->xml->database->host,$GLOBALS['config']->xml->database->user,$GLOBALS['config']->xml->database->password,$GLOBALS['config']->xml->database->db); //get the config from config file
		} catch (Exception $e){
			$request->setMsg("error","DataBase","Database couldn't be reached!");
		}
		
		$data=$db->simpleQuery("SELECT * FROM requestlog");
		$view->assign("data",$data);
	}
} 

?> 