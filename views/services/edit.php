<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("santero");

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION["user_id"]]);
$service = $stmt->fetch();

if (!$service) {
    die("Servicio no encontrado");
}
?>

<h2>Editar servicio</h2>

<form action="../../controllers/services/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $service["id"] ?>">

    <input type="text" name="titulo" value="<?= $service["titulo"] ?>" required><br><br>

    <textarea name="descripcion" required><?= $service["descripcion"] ?></textarea><br><br>

    <input type="number" step="0.01" name="precio" value="<?= $service["precio"] ?>" required><br><br>

    <select name="modalidad" required>
        <option value="virtual" <?= $service["modalidad"] == "virtual" ? "selected" : "" ?>>Virtual</option>
        <option value="presencial" <?= $service["modalidad"] == "presencial" ? "selected" : "" ?>>Presencial</option>
    </select><br><br>

    <input type="text" name="categoria" value="<?= $service["categoria"] ?>" required><br><br>

    <button type="submit">Actualizar</button>
</form>
