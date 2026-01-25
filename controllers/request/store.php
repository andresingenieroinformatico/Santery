<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$service_id = $_POST["service_id"];
$mensaje = trim($_POST["mensaje"]);
$cliente_id = $_SESSION["user_id"];

$stmt = $pdo->prepare(
    "INSERT INTO requests (service_id, cliente_id, mensaje)
    VALUES (?, ?, ?)"
);

$stmt->execute([$service_id, $cliente_id, $mensaje]);

header("Location: ../../views/requests/my_requests.php");
exit;
