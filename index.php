<?php
session_start();

/* Si NO está logueado */
if (!isset($_SESSION["user_id"])) {
    header("Location: views/auth/login.php");
    exit;
}

/* Si está logueado */
switch ($_SESSION["rol"]) {
    case "cliente":
        header("Location: views/services/list.php");
        break;

    case "santero":
        header("Location: views/services/create.php");
        break;

    default:
        // Por seguridad
        session_destroy();
        header("Location: views/auth/login.php");
}
exit;
