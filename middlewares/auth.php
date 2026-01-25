<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay sesión activa
if (!isset($_SESSION["user_id"])) {
    header("Location: /santeria/views/auth/login.php");
    exit;
}
