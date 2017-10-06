<?php 
class Model_User { 

/*
*	Class handling a user
*	
*
*/
	private $account;
	private $nickname;
	private $picture;
	private $email;
	private $authorizationLevel;
	
	function __construct($account,$nickname,$picture,$email,$authorizationLevel)
	{ 
		$this->account=$account;
		$this->nickname=$nickname;
		$this->picture=$picture;
		$this->email=$email;
		$this->authorizationLevel=$authorizationLevel;
	}
	
	public function isLoggedIn()
	{
		$GLOBALS['session']->inSession('user');
	}
	public function loginIn()
	{
		$GLOBALS['session']->set('user',$this);
	}
	
	public function getLevel()
	{
		$this->authorizationLevel;
	}
	
	public function getNick()
	{
		return $this->nickname;
	}
	
} 

?> 