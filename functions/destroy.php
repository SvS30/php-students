<?php
session_start();

include_once('../includes/connection.php');

if (isset($_POST['id'])) {
    $studentId = $_POST['id'];
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    if ($stmt->execute()) echo json_encode(['success' => true, 'message' => 'Estudiante eliminado con exito']);
    else echo json_encode(['success' => false, 'message' => 'No se pudo realizar la eliminación del estudiante']);
    $conn->close();
} else {
    echo 'No se recibió el ID del estudiante';
}