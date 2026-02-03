<?php
session_start();

/* Si NO esta logueado */
if (!isset($_SESSION["user_id"])) {
    header("Location: views/auth/base.php");
    exit;
}

/* Si esta logueado */
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
        header("Location: views/auth/base.php");
}
exit;
