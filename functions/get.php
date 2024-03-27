<?php
session_start();

include_once('../includes/connection.php');

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $sql = "SELECT id, name, first_last_name, second_last_name, grade, serial  FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $conn->close();
    echo json_encode(['success' => true, 'data' => $student]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se recibió el ID del estudiante']);
}