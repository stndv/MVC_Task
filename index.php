<!DOCTYPE html>
<html>
<head>
	<title>MVC Task</title>
	<style>
</style>
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
	<?php	
	//-----------------------------
	try {
		//pagination
	$numperpage = 3;
	//find out how many total records
	//find out how many pagination links based on total/numperpage
	$countsql = $db->prepare("SELECT COUNT(id) from mytable");
	$countsql->execute();
	$row = $countsql->fetch();
	$numrecords = $row[0];
	$numlinks = ceil($numrecords/$numperpage);
	//var_dump(ceil($numrecords));
	//var_dump(ceil($numlinks));

	//create a page
	$page = (isset($_GET['start']))?$_GET['start']:0;
	
	$start = $page * $numperpage; 
	
	$sortname = (isset($_GET['sort']))?$_GET['sort']:0;
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
	if($sortname == 'sname') {
		$stmt = $db->prepare("SELECT name,email,task FROM mytable ORDER BY name ");
	}
	else if($sortname == 'semail') {
		$stmt = $db->prepare("SELECT name, email, task FROM mytable ORDER BY email");
	}
	else{
		$stmt = $db->prepare("SELECT name, email, task from mytable LIMIT $start, $numperpage");
	}
	$stmt->execute();
	while($row = $stmt->fetch()){
		$name = $row[0];
		$email = $row[1];
		$task = $row[2];
		echo "$name <br>";
		echo "$email <br>";
		echo "$task <br>";
		echo "<hr>";
	}
		
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	  
	//navigation through pages (using QUERY_STRING) pagination
	for($i=0; $i < $numlinks; $i++){
		$y=$i + 1;
		echo '<b><a href="index.php?start='.$i.'">'.$y.' </a>';
	}

	  $db = null;
?>
	<a href="?sort=sname">Name:</a>
    <a href="?sort=semail">Email:</a>
</body>
