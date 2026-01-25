<?php
session_start();
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $pass  = $_POST["password"];

    if (empty($email) || empty($pass)) {
        die("Todos los campos son obligatorios");
    }

    $stmt = $pdo->prepare("SELECT id, nombre, password, rol FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user["password"])) {

        // Crear sesión
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nombre"]  = $user["nombre"];
        $_SESSION["rol"]     = $user["rol"];

        // 👉 SIEMPRE ir al dashboard
        header("Location: ../views/dashboard.php");
        exit;

    } else {
        // Error genérico por seguridad
        die("Correo o contraseña incorrectos");
    }
}

