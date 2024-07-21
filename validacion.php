<?php
session_start();

if (isset($_SESSION['id'])) {
    // Si hay sesión iniciada, obtener el rol del usuario desde la sesión
    $user_role = $_SESSION['role'];

    if ($user_role == 1) {
        // Si el rol es 1 (usuario), cargar encabezadoStart.php
        include 'encabezado.php';
    } else {
        // Si el rol no es 1, cerrar la sesión y redirigir al inicio de sesión
        session_unset(); // Liberar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        header("Location: Login0/login.php");
        exit();
    }
} else {
    // Si no hay sesión iniciada, redirigir al inicio de sesión
    header("Location: Login0/login.php");
    exit();
}
?>
