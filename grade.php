<?php

include 'connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['grade'], $_GET['payment'])) {
    if (!empty($_GET['grade']) && !empty($_GET['payment'])) {
        if($_GET['action'] === 'insert'){
            $grade = $_GET['grade'];
            $payment = $_GET['payment'];
    
            $sql = "INSERT INTO grade (grade, payment) VALUES (:grade, :payment)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['grade' => $grade, 'payment' => $payment]);
    
            echo json_encode(['message' => 'Data inserted successfully']);
        }else if($_GET['action'] === 'getdata'){
            
            $sql = "SELECT * FROM grade WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $)
        }else{
            echo json_encode(['message' => 'not inserted']);
        }
       
    } else {
        echo json_encode(['error' => 'All fields are required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}


?>
