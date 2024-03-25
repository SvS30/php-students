<?php
// Configuración de la base de datos
$db_host = 'localhost';
$db_username = '';
$db_password = '';
$db_name = '';

// Crear conexión
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
