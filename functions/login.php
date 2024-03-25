<?php
session_start();

// Incluir archivo de conexión
include_once('../includes/connection.php');

// Función para validar las credenciales en la base de datos
function validar_credenciales($conn, $username, $password) {
    // Consulta SQL para obtener el usuario de la base de datos
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $passwordVerify = password_verify($password, $user['password']);
    return ($user && $passwordVerify) ? true : false;
}

// Función para manejar la redirección y los mensajes de error
function redirigir($url, $mensaje_error = null) {
    if ($mensaje_error) {
        $_SESSION['error'] = $mensaje_error;
    }
    header("Location: $url");
    exit();
}

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar credenciales
    if (validar_credenciales($conn, $username, $password)) {
        // Usuario autenticado, iniciar sesión
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        redirigir('../public/home.php');
    } else {
        // Usuario o contraseña incorrectos, mostrar mensaje de error
        redirigir('../index.php', "Credenciales incorrectas.");
    }
} else {
    // Redirigir si se accede directamente a este script sin enviar datos del formulario
    redirigir('../index.php');
}