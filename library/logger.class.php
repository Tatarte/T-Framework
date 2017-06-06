<?php 
class Library_Logger {  //Manages the logs
    
	private $logFile;
	
	function __construct($file) {  //Make a singleton??
		$this->logFile=$file;
	}
	public function log($message)
	{
		file_put_contents($this->logFile, $message, FILE_APPEND | LOCK_EX);  //confirm perf vs keeping file open.
	}
} 

?> 