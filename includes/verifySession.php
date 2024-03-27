<?php

session_start();

function validateSession() {
    // Verificar si no hay una sesión iniciada
    if (!isset($_SESSION['username'])) {
        // Redireccionar al usuario al formulario de inicio de sesión
        $loginRoute = __DIR__ . '/index.php';
        header("Location: ".$loginRoute);
        exit();
    }
    // Si hay una sesión iniciada, el usuario está autenticado
}