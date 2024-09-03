<?php

include 'connection.php';

$id = $_POST['id'];
$grade = $_POST['grade'];
$payment = $_POST['payment'];


if (!isset($grade) || empty($grade)) {
    die('Error: Grade cannot be null or empty');
}

$sql = "INSERT INTO grade (id, grade, payment) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    if ($stmt->execute([$id, $grade, $payment])) {
        echo 'Record added successfully';
    } else {
        echo 'Error: ' . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
