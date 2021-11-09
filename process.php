<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $u_name = filter_var($_GET["user_name"], FILTER_SANITIZE_STRING); 
    $u_email = filter_var($_GET["user_email"], FILTER_SANITIZE_EMAIL); 
    $u_task = filter_var($_GET["user_task"], FILTER_SANITIZE_STRING);
    
    if(empty($u_name)){die("Enter your name M...F...");}
    if(empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){die("Enter Email");}
    if(empty($u_task)){die("Enter your Task");}    

    print("$u_name <br>"); 
    print("$u_email<br>");
    print("$u_task <br>");
}


?>