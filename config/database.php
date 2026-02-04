<?php
$host = gethostbyname("sql305.infinityfree.com");
$db   = "if0_40991675_santeria_db"; // 👈 NOMBRE REAL, NO XXX
$user = "if0_40991675";
$pass = "4d84ka16na3g";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
