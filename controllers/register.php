
<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $email  = trim($_POST["email"]);
    $pass   = $_POST["password"];
    $rol    = $_POST["rol"];

    if (empty($nombre) || empty($email) || empty($pass) || empty($rol)) {
        die("Todos los campos son obligatorios");
    }

    // Verificar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        die("El correo ya está registrado");
    }

    // Encriptar contraseña
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $pdo->prepare(
        "INSERT INTO users (nombre, email, password, rol)
        VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $email, $passwordHash, $rol]);

    header("Location: ../views/auth/login.php");
    exit;
}
