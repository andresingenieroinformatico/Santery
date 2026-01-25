<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$id = $_GET["id"] ?? null;

$stmt = $pdo->prepare(
    "SELECT s.*, u.nombre AS santero, u.email
     FROM services s
     JOIN users u ON s.user_id = u.id
     WHERE s.id = ?"
);
$stmt->execute([$id]);
$service = $stmt->fetch();

if (!$service) {
    die("Servicio no encontrado");
}

/* =========================
   OBTENER RESEÑAS DEL SERVICIO
   ========================= */
$stmt = $pdo->prepare(
    "SELECT r.calificacion, r.comentario, r.fecha, u.nombre
     FROM reviews r
     JOIN users u ON r.cliente_id = u.id
     WHERE r.service_id = ?
     ORDER BY r.fecha DESC"
);
$stmt->execute([$service["id"]]);
$reviews = $stmt->fetchAll();

/* =========================
   PROMEDIO DE CALIFICACIÓN
   ========================= */
$stmt = $pdo->prepare(
    "SELECT ROUND(AVG(calificacion),1)
     FROM reviews
     WHERE service_id = ?"
);
$stmt->execute([$service["id"]]);
$rating = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($service["titulo"]) ?></title>
</head>
<body>

<h2><?= htmlspecialchars($service["titulo"]) ?></h2>

<p><strong>Santero:</strong> <?= htmlspecialchars($service["santero"]) ?></p>
<p><strong>Categoría:</strong> <?= htmlspecialchars($service["categoria"]) ?></p>
<p><strong>Modalidad:</strong> <?= $service["modalidad"] ?></p>
<p><strong>Precio:</strong> <?= $service["precio"] ?></p>

<p>
    <strong>Calificación:</strong>
    <?= $rating ? "⭐ {$rating}/5" : "Sin calificar" ?>
</p>

<hr>

<p><?= nl2br(htmlspecialchars($service["descripcion"])) ?></p>

<hr>

<h3>⭐ Reseñas</h3>

<?php if (empty($reviews)): ?>
    <p>Aún no hay reseñas para este servicio.</p>
<?php endif; ?>

<?php foreach ($reviews as $rev): ?>
    <div style="border-bottom:1px solid #ccc; margin-bottom:10px; padding-bottom:10px;">
        <p>
            <strong><?= htmlspecialchars($rev["nombre"]) ?></strong>
            — ⭐ <?= $rev["calificacion"] ?>/5
        </p>
        <p><?= nl2br(htmlspecialchars($rev["comentario"])) ?></p>
        <small><?= $rev["fecha"] ?></small>
    </div>
<?php endforeach; ?>

<hr>

<a href="list.php">← Volver</a> |
<a href="../requests/create.php?service_id=<?= $service["id"] ?>">
    Solicitar servicio
</a>

</body>
</html>
