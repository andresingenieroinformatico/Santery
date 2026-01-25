<?php
session_start();
require_once "../../config/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/auth/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$nombre   = trim($_POST["nombre"]);
$email    = trim($_POST["email"]);
$whatsapp = $_POST["whatsapp"] ?? null;

/* Validaciones básicas */
if (strlen($nombre) < 3) {
    die("Nombre inválido");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido");
}

/* Obtener rol del usuario */
$stmt = $pdo->prepare("SELECT rol FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$rol = $stmt->fetchColumn();

/* Si NO es santero, no guardamos WhatsApp */
if ($rol !== "santero") {
    $whatsapp = null;
}

/* Actualizar */
$stmt = $pdo->prepare(
    "UPDATE users
    SET nombre = ?, email = ?, whatsapp = ?
    WHERE id = ?"
);

$stmt->execute([
    $nombre,
    $email,
    $whatsapp,
    $user_id
]);

header("Location: ../../views/dashboard.php?success=1");
exit;
