<?php
    $host = "localhost";      
    $db_name = "explore_vacations"; 
    $username = "root";       
    $password = "";          

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Database connected successfully!";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }
?>
