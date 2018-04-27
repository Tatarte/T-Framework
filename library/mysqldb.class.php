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
			throw new Exception("Failed to connect to MySQL: ( ".$this->mysqli->connect_errno." ) ".$this->mysqli->connect_error);
		}

	}
	
	public function simpleQuery($statement,$params=null,$index=null)  //Handles a simple MySQL query in one call and return an associative array
	{
		if (!($stmt = $this->mysqli->prepare($statement))) {
			throw new Exception("Failed to prepare MySQLI statement: ( ".$this->mysqli->connect_errno." ) ".$this->mysqli->connect_error);
		}
		if ($params!=null)
		{
			if(!call_user_func_array(array($stmt,'bind_param'),$params)) // Check reference &passed argument consequences
			##if (!$stmt->bind_param())
			{
				throw new Exception("Failed to bind MySQLI statement: (". $this->mysqli->connect_errno." ) ".$this->mysqli->connect_error);
			}
		}
		if (!$stmt->execute()) {
			throw new Exception("Failed to execute MySQLI statement: ( ".$this->mysqli->connect_errno." ) ".$this->mysqli->connect_error);
		}
		$result = array();
        $stmt->store_result();
        
        $variables = array();
        $data = array();
        $meta = $stmt->result_metadata();
        
		if ($meta!=false)
		{
			while($field = $meta->fetch_field())
				if ($index!=null AND $field->name==$index)  // the field re-arrange doesn't work
				{
					array_unshift($variables,null);
					$variables[0]=&$data[$field->name];
				}else{
					$variables[] = &$data[$field->name]; 
				}
			
			call_user_func_array(array($stmt, 'bind_result'), $variables);
			
			
			$i=0;
			while($stmt->fetch())
			{
				if ($index!=null)
				{
					$key=null;
					$multiple=false;
					foreach($data as $k=>$v)
						if ($k==$index)
						{
							$key=$v;
							if (isset($result[$key]) AND is_int(key($result[$key]))) // if order is important for ifs not to be triggered in the same loop
							{
								array_push($result[$key],array());
								$multiple=true;
							}
							if (isset($result[$key]) AND !is_int(key($result[$key])))
							{
								$temp=$result[$key];
								$result[$key] = array($temp,array());
								$multiple=true;
							}
							if (!isset($result[$key]))
							{
								$result[$key] = array();
								$multiple=false;
							}
						}else
						{
							if ($multiple)
							{
								$result[$key][count($result[$key])-1][$k] = $v;
							}else
							{
								$result[$key][$k] = $v;
							}
						}
				}else
				{
					$result[$i] = array();
					foreach($data as $k=>$v)
						$result[$i][$k] = $v;
					$i++;
				}
			}
			return $result;
		}
		// else return success??
	}
	
	public function getAutoIncrement()
	{
		return $this->mysqli->insert_id;
	}
	
	public function close()
	{
		$this->mysqli->close();
	}
} 

?> 