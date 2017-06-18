<h2>MySQL simple implementation</h2>
<?PHP 

if (isset($this->data['error']))
{
	print($this->data['error']."<br/>");
}
else{
	echo "You are successfully connected to the Database!<br/>";
	if  (!empty($this->data['data']))
	{
		echo "Find the data:<br/>";
		foreach($this->data['data'] as $row)
		{
			echo("LastName= ".$row['lastName']." - FirstName= ".$row['firstName']." : ".$row['age']."<br/>");
		}
	}else{
		echo "Your query didn't yield any result";
	}
}

?>