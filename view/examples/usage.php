<table>
<tr><th>Page</th><th>Action</th><th>Params</th></tr>
<?php foreach($this->data['data'] as $row):?>
		<tr><td><?php echo $row['page']?></td><td><?php echo $row['action']?></td><td><?php echo $row['parameter']?></td></tr>
<?php endforeach;?>
</table>