<?php

include_once('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $studentId = $_POST['studentId'];
    $name = $_POST['name'];
    $first_last_name = $_POST['first_last_name'];
    $second_last_name = $_POST['second_last_name'];
    $serial = $_POST['serial'];
    $grade = $_POST['grade'];

    try {
        $sql = "UPDATE students SET name=?, first_last_name=?, second_last_name=?, serial=?, grade=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $first_last_name, $second_last_name, $serial, $grade, $studentId);
        $stmt->execute();
        echo json_encode(array("success" => true, "message" => "Estudiante actualizado exitosamente."));
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Error al actualizar el estudiante: " . $e));
    } finally {
        $stmt->close();
        $conn->close();
    }
}