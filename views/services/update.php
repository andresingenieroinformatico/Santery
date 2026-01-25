<?php
require_once "../../config/database.php";
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";

checkRole("santero");

$stmt = $pdo->prepare(
    "UPDATE services
    SET titulo=?, descripcion=?, precio=?, modalidad=?, categoria=?
    WHERE id=? AND user_id=?"
);

$stmt->execute([
    $_POST["titulo"],
    $_POST["descripcion"],
    $_POST["precio"],
    $_POST["modalidad"],
    $_POST["categoria"],
    $_POST["id"],
    $_SESSION["user_id"]
]);

header("Location: ../../views/services/my_services.php");
exit;
