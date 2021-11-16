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

	//create a page
	$page = (isset($_GET['start']))?$_GET['start']:0;
	
	$start = $page * $numperpage; 
	// сортировка через $_GET и выбор как отображать данные
	$sortname = (isset($_GET['sort']))?$_GET['sort']:0;
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	if($sortname == 'name') {
		$stmt = $db->prepare("SELECT id, name,email,task, idDone FROM mytable ORDER BY name ");
	}
	else if($sortname == 'email') {
		$stmt = $db->prepare("SELECT id, name, email, task, idDone FROM mytable ORDER BY email");
	}
	else{
		$stmt = $db->prepare("SELECT id, name, email, task, idDone from mytable LIMIT $start, $numperpage");
	}
	//Print current results
	echo "<table border=1><tr>
                <th>Name</th>
                <th>Email: </th>
                <th>Task</th>
				<th>Status</th>
				<th>Toggle</th></tr>";
	
	$stmt->execute();
		while($info = $stmt->fetch()){
		//var_dump($info);die;
		$name = $info['name'];
		$email = $info['email'];
		$task = $info['task'];
		$status = ($info['idDone']=="1")?"Completed":"NotCompleted";
		$toggle = ($info['idDone']=="1")
                ?"<a href=deactivate.php?id=".$info['id'].">Deactivate</a>"
                :"<a href=activate.php?id=".$info['id'].">Activate</a>";
		echo "<tr> <td>$name</td> <td>$email</td> <td>$task</td> <td>$status</td> <td>$toggle</td>";
	}
	echo "</tr> </table>";
		
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
	<div>
		<p> Sort by:
			<a href="?sort=name">Name:</a> or by 
			<a href="?sort=email">Email:</a>
		</p>
	</div>	
</body>
