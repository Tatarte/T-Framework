<h2>T-Framework home page</h2>

<p>Hi and welcome to the T-Framework default home page. This is where I'm testing new features I'm currently implementing</p>
<p>I'm inviting you to procreed to the <a href='<?php echo SITE_ROOT?>/examples'>examples' page</a> for further details about the T-Framework usage</p>

<?php
if (isset($this->data['error']))
{
	print($this->data['error']."<br/>");
}
print("<h5>".$this->data['action']."</h5>");

?>

