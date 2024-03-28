<?php
session_start();

include_once('../includes/connection.php');

try {
    $sql = "SELECT id, name, first_last_name, second_last_name, grade, serial FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(array(
        "data" => $data
    ));
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener la información: ' . $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}
