<?php
require_once "../../config/database.php";
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";

checkRole("santero");

$id = $_GET["id"];

$stmt = $pdo->prepare(
    "DELETE FROM services WHERE id = ? AND user_id = ?"
);
$stmt->execute([$id, $_SESSION["user_id"]]);

header("Location: ../../views/services/my_services.php");
exit;
