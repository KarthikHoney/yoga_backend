<?php
include 'connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    try {
        if ($action === 'create') {
            $name = $_GET['name'];
            $email = $_GET['email'];
            $parentname = $_GET['parentname'];
            $dob = $_GET['dob'];
            $number = $_GET['number'];
            $password = $_GET['password'];
            $wnumber = $_GET['wnumber'];
            $address = $_GET['address'];

           
            $sql = "INSERT INTO individual_student (name, email, parentname, dob, address, password, wnumber, number) 
                    VALUES (:name, :email, :parentname, :dob, :address, :password, :wnumber, :number)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,  
                'parentname' => $parentname,
                'dob' => $dob,
                'address' => $address,
                'password' => $password,
                'wnumber' => $wnumber,
                'number' => $number
            ]);

            // Get the last inserted ID
            $lastInsertId = $pdo->lastInsertId();

            // Store the last inserted ID in the session
            $_SESSION['id'] = $lastInsertId;

            echo json_encode(['message' => 'Record created successfully']);
        } elseif ($action === 'update') {
            $id = $_GET['id'];
            $name = $_GET['name'];
            $email = $_GET['email'];

            $sql = "UPDATE individual_student SET name = :name, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email]);

            // Update the session ID
            $_SESSION['id'] = $id;

            echo json_encode(['message' => 'Record updated successfully']);
        } elseif ($action === 'delete') {
            $id = $_GET['id'];

            $sql = "DELETE FROM individual_student WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            // Remove the session ID if the deleted ID matches
            if ($_SESSION['id'] == $id) {
                unset($_SESSION['id']);
            }
            echo json_encode(['message' => 'Record deleted successfully']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    try {
        $sql = "SELECT * FROM individual_student";
        $stmt = $pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
