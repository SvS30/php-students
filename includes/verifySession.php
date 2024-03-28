<?php

session_start();

function validateSession() {
    // Verificar si no hay una sesión iniciada
    if (!isset($_SESSION['username'])) {
        $_SESSION['error'] = "Debes iniciar sesion";
        // Redireccionar al usuario al formulario de inicio de sesión
        $loginPath = '../../index.php';
        header('Location: ' . $loginPath);
        exit();
    }
    // Si hay una sesión iniciada, el usuario está autenticado
}