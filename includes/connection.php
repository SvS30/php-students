<?php
// Configuración de la base de datos
$dbHost = 'localhost';
$dbUsername = '';
$dbPassword = '';
$dbName = '';

// Crear conexión
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
