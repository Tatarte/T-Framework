<h1>MySQL simple implementation</h1>
<?PHP 

if (isset($this->data['error']))
{
	print($this->data['error']."<br/>");
}
else{
	echo "You are successfully connected to the Database!<br/>find the data:<br/>";
	foreach($this->data['data'] as $row)
	{
		echo("LastName= ".$row['lastName']." - FirstName= ".$row['firstName']." : ".$row['age']."<br/>");
	}
}

?>