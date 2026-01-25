<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$service_id = $_POST["service_id"];
$cliente_id = $_SESSION["user_id"];
$calificacion = $_POST["calificacion"];
$comentario = trim($_POST["comentario"]);

$stmt = $pdo->prepare(
    "INSERT INTO reviews (service_id, cliente_id, calificacion, comentario)
    VALUES (?, ?, ?, ?)"
);

$stmt->execute([$service_id, $cliente_id, $calificacion, $comentario]);

header("Location: ../../views/requests/my_requests.php");
exit;
