<?php
include 'connection.php';

session_start();

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'User must be logged in']);
    exit;
}

// Debugging session ID
error_log("Session ID: " . $_SESSION['id']);


if (isset($data['grade'], $data['payment'])) {
    $grade = $data['grade'];
    $payment = $data['payment'];
    $userId = $_SESSION['id'];

    try {
        $sql = "INSERT INTO grade (user_id, grade, payment) VALUES (:user_id, :grade, :payment)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'grade' => $grade, 'payment' => $payment]);

        echo json_encode(['message' => 'Data inserted successfully']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error inserting data: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'All fields are required']);
}
?>
