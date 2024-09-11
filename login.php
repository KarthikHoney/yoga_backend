<?php
session_start(); 

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $role = $_GET['action'];
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $password = isset($_GET['password']) ? $_GET['password'] : '';

    try {
        
        if ($role === 'individualstudent') {
            $sql = "SELECT * FROM individual_student WHERE name = :name";
        } else if ($role === 'trainerstudent') {
            $sql = "SELECT  * FROM trainer WHERE name = :name";
        } else {
            echo json_encode(['error' => 'Invalid role']);
            exit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
       

       

        if ($user && $user['password'] === $password) {
            
          

            echo json_encode($user);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
