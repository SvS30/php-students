<?php

include_once('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    // Obtiene los datos del formulario
    $studentId = $_POST['studentId'];
    $name = $_POST['name'];
    $first_last_name = $_POST['first_last_name'];
    $second_last_name = $_POST['second_last_name'];
    $serial = $_POST['serial'];
    $grade = $_POST['grade'];

    $sql = "UPDATE students SET name=?, first_last_name=?, second_last_name=?, serial=?, grade=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $first_last_name, $second_last_name, $serial, $grade, $studentId);

    if ($stmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Estudiante actualizado exitosamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al actualizar el estudiante: " . $conn->error));
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();
}