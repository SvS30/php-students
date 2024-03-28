<?php

include_once('../includes/connection.php');

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $name = $_POST['name'];
    $first_last_name = $_POST['first_last_name'];
    $second_last_name = $_POST['second_last_name'];
    $serial = $_POST['serial'];
    $grade = $_POST['grade'];
    try {
        $sql = "INSERT INTO students (name, first_last_name, second_last_name, serial, grade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $first_last_name, $second_last_name, $serial, $grade);
        $stmt->execute();
        echo json_encode(array("success" => true, "message" => "Estudiante creado exitosamente."));
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Error al crear el estudiante: " . $e));
    } finally {
        $stmt->close();
        $conn->close();
    }
}