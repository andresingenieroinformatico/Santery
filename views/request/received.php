<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("santero");

$stmt = $pdo->prepare(
    "SELECT r.*, s.titulo, u.nombre AS cliente
     FROM requests r
     JOIN services s ON r.service_id = s.id
     JOIN users u ON r.cliente_id = u.id
     WHERE s.user_id = ?
     ORDER BY r.fecha DESC"
);
$stmt->execute([$_SESSION["user_id"]]);
$requests = $stmt->fetchAll();
?>

<h2>Solicitudes recibidas</h2>

<?php foreach ($requests as $r): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3><?= htmlspecialchars($r["titulo"]) ?></h3>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($r["cliente"]) ?></p>
        <p><?= htmlspecialchars($r["mensaje"]) ?></p>
        <p>Estado actual: <strong><?= $r["estado"] ?></strong></p>

        <?php if ($r["estado"] === "pendiente"): ?>
            <a href="../../controllers/requests/update_status.php?id=<?= $r["id"] ?>&estado=aceptado">
                Aceptar
            </a> |
            <a href="../../controllers/requests/update_status.php?id=<?= $r["id"] ?>&estado=rechazado">
                Rechazar
            </a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
