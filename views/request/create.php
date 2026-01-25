<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$service_id = $_GET["service_id"] ?? null;

$stmt = $pdo->prepare(
    "SELECT s.titulo, u.nombre 
    FROM services s
    JOIN users u ON s.user_id = u.id
    WHERE s.id = ?"
);
$stmt->execute([$service_id]);
$service = $stmt->fetch();

if (!$service) {
    die("Servicio no encontrado");
}
?>

<h2>Solicitar servicio</h2>

<p><strong>Servicio:</strong> <?= htmlspecialchars($service["titulo"]) ?></p>
<p><strong>Santero:</strong> <?= htmlspecialchars($service["nombre"]) ?></p>

<form action="../../controllers/requests/store.php" method="POST">
    <input type="hidden" name="service_id" value="<?= $service_id ?>">

    <textarea name="mensaje" placeholder="Describe tu necesidad..." required></textarea><br><br>

    <button type="submit">Enviar solicitud</button>
</form>

<a href="../services/list.php">Cancelar</a>
