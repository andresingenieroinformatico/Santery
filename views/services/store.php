<?php
require_once "../../config/database.php";
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";

checkRole("santero");

$titulo = trim($_POST["titulo"]);
$descripcion = trim($_POST["descripcion"]);
$precio = $_POST["precio"];
$modalidad = $_POST["modalidad"];
$categoria = trim($_POST["categoria"]);
$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare(
    "INSERT INTO services (user_id, titulo, descripcion, precio, modalidad, categoria)
    VALUES (?, ?, ?, ?, ?, ?)"
);

$stmt->execute([
    $user_id,
    $titulo,
    $descripcion,
    $precio,
    $modalidad,
    $categoria
]);

header("Location: ../../views/services/my_services.php");
exit;
