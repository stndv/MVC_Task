<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){

    $u_name = filter_var($_GET["user_name"], FILTER_SANITIZE_STRING); 
    $u_email = filter_var($_GET["user_email"], FILTER_SANITIZE_EMAIL); 
    $u_task = filter_var($_GET["user_task"], FILTER_SANITIZE_STRING);
    
    //connection parameters
    $db_host = "localhost";
    $db_user = "root";
    $db_passw = "";
    $db_base = "api_db";
    $db_table = "mytable";
    
    try {
        // Подключение к базе данных
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_passw);
        // Устанавливаем корректную кодировку
        $db->exec("set names utf8");
        // Собираем данные для запроса
        $data = array( 'name' => $u_name, 'email' => $u_email, 'task' => $u_task ); 
        
        //Check whether fields are not empty
        if(empty($u_name)){die("Enter your name M...F...");}
        if(empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){die("Enter Email");}
        if(empty($u_task)){die("Enter your Task");}    
        
        // Подготавливаем SQL-запрос
        $query = $db->prepare("INSERT INTO $db_table (name, email, task) values (:name, :email, :task)");
        // Выполняем запрос с данными
        $query->execute($data);
        // Запишим в переменую, что запрос отрабтал
        $result = true;
    } catch (PDOException $e) {
        // Если есть ошибка соединения или выполнения запроса, выводим её
        print "Ошибка!: " . $e->getMessage() . "<br/>";
    }
    
    if ($result) {
    	echo "Успех. Информация занесена в базу данных";
    }
}
    
?>