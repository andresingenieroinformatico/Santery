<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$stmt = $pdo->prepare(
    "SELECT r.*, s.titulo
    FROM requests r
    JOIN services s ON r.service_id = s.id
    WHERE r.cliente_id = ?
    ORDER BY r.fecha DESC"
);
$stmt->execute([$_SESSION["user_id"]]);
$requests = $stmt->fetchAll();
?>

<h2>Mis solicitudes</h2>

<?php foreach ($requests as $r): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3><?= htmlspecialchars($r["titulo"]) ?></h3>
        <p><?= htmlspecialchars($r["mensaje"]) ?></p>
        <p>Estado: <strong><?= $r["estado"] ?></strong></p>
        <small><?= $r["fecha"] ?></small>
    </div>
<?php endforeach; ?>

<?php foreach ($requests as $r): ?>
    <?php if ($r["estado"] === "aceptado"): ?>
        <a href="../reviews/create.php?service_id=<?= $r["service_id"] ?>">
            ⭐ Dejar reseña
        </a>
    <?php endif; ?>
<?php endforeach; ?>