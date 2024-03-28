<?php
session_start();

include_once('../includes/connection.php');

if (isset($_POST['id'])) {
    $studentId = $_POST['id'];
    try {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Estudiante eliminado con exito']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el estudiante: ' . $e]);
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo 'No se recibió el ID del estudiante';
}