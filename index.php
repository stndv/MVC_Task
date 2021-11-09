<!DOCTYPE html>
<html>
<head>
	<title>MVC Task</title>
	<STYLE>A {text-decoration: none;} </STYLE>
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
	//pagination
	$numperpage = 3;
	//find out how many total records
	//find out how many pagination links based on total/numberpage
	$countsql = $db->prepare("SELECT COUNT(id) from mytable");
	$countsql->execute();
	$row = $countsql->fetch();
	$numrecords = $row[0];
	$numlinks = ceil($numrecords/$numperpage);
	//var_dump(ceil($numrecords));
	//var_dump(ceil($numlinks));

	//create a page
	$page = $_GET['start'];
	if(!$page) $page=0;
	$start = $page * $numperpage; 

	//Show all current records!
	$sql = $db->prepare("SELECT name, email, task from mytable LIMIT $start, $numperpage");
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

	//navigation through pages (using QUERY_STRING)
	for($i=0; $i < $numlinks; $i++){
		$y=$i + 1;
		echo '<b><a href="index.php?start='.$i.'">'.$y.' </a>';
	}
	?>
</body>
