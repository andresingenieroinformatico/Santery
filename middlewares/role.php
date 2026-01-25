<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkRole($rolePermitido) {
    if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== $rolePermitido) {
        echo "Acceso denegado";
        header("Location: ../auth/login.php");
        exit;
    }
}
