<?php

include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['grade'], $_GET['payment'])) {
    if (!empty($_GET['grade']) && !empty($_GET['payment'])) {
        $grade = $_GET['grade'];
        $payment = $_GET['payment'];

        $sql = "INSERT INTO grade (grade, payment) VALUES (:grade, :payment)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['grade' => $grade, 'payment' => $payment]);

        echo json_encode(['message' => 'Data inserted successfully']);
    } else {
        echo json_encode(['error' => 'All fields are required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}


?>
