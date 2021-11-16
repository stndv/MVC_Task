<?php

//db connection parameters
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
    //$db = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//--------------------
/*class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  
    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
  
    function beginChildren() {
      echo "<tr>";
    }
  
    function endChildren() {
      echo "</tr>" . "\n";
    }
  }
*/
?>

