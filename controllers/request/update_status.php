<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("santero");

$id = $_GET["id"];
$estado = $_GET["estado"];

if (!in_array($estado, ["aceptado", "rechazado"])) {
    die("Estado inválido");
}

$stmt = $pdo->prepare(
    "UPDATE requests r
    JOIN services s ON r.service_id = s.id
    SET r.estado = ?
    WHERE r.id = ? AND s.user_id = ?"
);

$stmt->execute([$estado, $id, $_SESSION["user_id"]]);

header("Location: ../../views/requests/received.php");
exit;
