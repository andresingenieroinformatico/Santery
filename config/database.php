<?php
// Detectar si estamos en entorno LOCAL (Windows / XAMPP / Laragon)
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

    // ===== LOCAL =====
    $host = "localhost";
    $db   = "santeria_db";
    $user = "root";
    $pass = "Da12072022";

} else {

    // ===== INFINITYFREE =====
    $host = "sql305.infinityfree.com";
    $db   = "if0_40991675_XXX"; // nombre REAL exacto
    $user = "if0_40991675";
    $pass = "4d84ka16na3g";
}

// Conexión MySQLi
$conexion = mysqli_connect($host, $user, $pass, $db, 3306);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
return $conexion;
?>