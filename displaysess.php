<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>display</title>
</head>
<body>
<table border="1">
	<tr>
		<th>Sl_no</th>
		<th>Name</th>
		<th>Email</th>
		<th>Address</th>
		<th>phone</th>
		<th>Gender</th>
		<th>Degree</th>
		<th>Language</th>
		<th>Pictures</th>
		<th>Action</th>
	</tr>
<?php
$i=1;
foreach ($data as $row) 
{

	?>
	<tr>
		<td><?php echo $i;$i++; ?></td>
		<td><?php echo $row->name?></td>
		<td><?php echo $row->email?></td>
		<td><?php echo $row->address?></td>
		<td><?php echo $row->phone?></td>
		<td><?php echo $row->gender?></td>
		<td><?php echo $row->degree?></td>
		<td><?php echo $row->language?></td>
		<td><img src="<?php echo base_url().$row->picsource ?>" height="50" width="100"></td>
		<td><a href="editdata?ep=<?php echo $row->user_id?>">edit</a>
			<a href="">change password</a>
			<a href="logoutdata?logout=<?php echo $row->user_id?>">logout</a>
		</td>
	</tr>
	<?php
}
?>
</table>
</body>
</html>