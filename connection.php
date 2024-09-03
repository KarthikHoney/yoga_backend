<?php
$host = 'localhost';
$dbname = 'yoga';
$username = 'root';
$password = '';

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    echo json_encode(['error' => "Connection failed: " . $e->getMessage()]);
    exit();
}

if($pdo){
    echo 'success0';

}else{
    echo 'failed';
}

header('Content-Type: application/json');

?>