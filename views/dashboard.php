<?php
require_once "../middlewares/auth.php";


$rol = $_SESSION["rol"];

if ($rol === "santero") {
    header("Location: dashboard_santero.php");
} else {
    header("Location: dashboard_cliente.php");
}
exit;
