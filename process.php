<?php
include('connect.php');

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $u_name = filter_var($_GET["user_name"], FILTER_SANITIZE_STRING); 
    $u_email = filter_var($_GET["user_email"], FILTER_SANITIZE_EMAIL); 
    $u_task = filter_var($_GET["user_task"], FILTER_SANITIZE_STRING);
    
       
       try {
        // Собираем данные для запроса
        $data = array( 'name' => $u_name, 'email' => $u_email, 'task' => $u_task ); 
        
        //Check whether GET HEADER fields are not empty
        if(empty($u_name)){die("Enter your name M...F...");}
        if(empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){die("Enter Email");}
        if(empty($u_task)){die("Enter your Task");}    
        
        // Подготавливаем SQL-запрос
        $query = $db->prepare("INSERT INTO $db_table (name, email, task) values (:name, :email, :task)");
        // Выполняем запрос с данными
        $query->execute($data);
        // Запишем в переменую, что запрос отрабтал
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