<?php 
class Library_MySQLDB {  //Manages  Mysql database calls

	private $mysqli;
	
    function __construct($host,$user,$password,$db,$port="3306") {
		try{
			mysqli_report(MYSQLI_REPORT_STRICT); 
			$this->mysqli = new mysqli($host,$user,$password,$db,$port);
			$connected = true; 
		}catch (mysqli_sql_exception $e)
		{
			throw $e; 
		}
		if ($this->mysqli->connect_errno) {
			throw new Exception("Failed to connect to MySQL: ( $mysqli->connect_errno ) $mysqli->connect_error");
		}

	}
	
	public function simpleQuery($statement,$params=array())
	{
		if (!($stmt = $this->mysqli->prepare($statement))) {
			throw new Exception("Failed to prepare MySQLI statement: ( $mysqli->connect_errno ) $mysqli->connect_error");
		}
		foreach ($params as $param=>$value)
		{
			if (!($stmt->bind_param($param,$value))) {
				throw new Exception("Failed to bind MySQLI statement: ( $mysqli->connect_errno ) $mysqli->connect_error");
			}
		}
		if (!$stmt->execute()) {
			throw new Exception("Failed to execute MySQLI statement: ( $mysqli->connect_errno ) $mysqli->connect_error");
		}
		$result = array();
        $stmt->store_result();
        
        $variables = array();
        $data = array();
        $meta = $stmt->result_metadata();
        
        while($field = $meta->fetch_field())
            $variables[] = &$data[$field->name]; 
        
        call_user_func_array(array($stmt, 'bind_result'), $variables);
        
        $i=0;
        while($stmt->fetch())
        {
            $result[$i] = array();
            foreach($data as $k=>$v)
                $result[$i][$k] = $v;
            $i++;
            
        }
		return $result;
	}
} 

?> 