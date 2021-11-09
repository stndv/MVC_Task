<!DOCTYPE html>
<html>
<head>
	<title>MVC Task</title>
	<?php include_once('connect.php');?>
</head>
<body>
	<form method='get' action="process.php">
		Name: <input type="text" name="user_name" placeholder="Enter Your Name"> <br>
		Email: <input type="email" name="user_email" placeholder="Enter Your Email"> <br>
		Task: <textarea name="user_task" id="" cols="30" rows="10"></textarea> <br>
		<input type="submit" value="Add">
	</form>	

	<p>Пагинация МФ</p>
	<hr>

	<?php
	//Show all current records!
	$sql = $db->prepare("SELECT name, email, task from mytable");
	$sql->execute();
	while($row = $sql->fetch()){
		$name = $row[0];
		$email = $row[1];
		$task = $row[2];
		echo "$name <br>";
		echo "$email <br>";
		echo "$task <br>";
		echo "<hr>";
	}

	//pagination
	$numberpage = 3;
	//find out how many total records
	//find out how many pagination links based on total/numberpage
	$countsql = $db->prepare("SELECT COUNT(id) from mytable");
	$countsql->execute();
	$row = $countsql->fetch();
	$numrecords = $row[0];
	$numlinks = ceil($numrecords/$numberpage);
	//var_dump(ceil($numrecords));
	var_dump(ceil($numlinks));

	//display 
	?>
</body>
