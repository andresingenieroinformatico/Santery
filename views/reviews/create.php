<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";

checkRole("cliente");

$service_id = $_GET["service_id"];
$cliente_id = $_SESSION["user_id"];

// Verificar que exista solicitud aceptada
$stmt = $pdo->prepare(
    "SELECT r.id
    FROM requests r
    WHERE r.service_id = ?
    AND r.cliente_id = ?
    AND r.estado = 'aceptado'"
);
$stmt->execute([$service_id, $cliente_id]);

if (!$stmt->fetch()) {
    die("No puedes reseñar este servicio");
}
?>

<h2>Dejar reseña</h2>

<form action="../../controllers/reviews/store.php" method="POST">
    <input type="hidden" name="service_id" value="<?= $service_id ?>">

    <label>Calificación:</label><br>
    <select name="calificacion" required>
        <option value="">Seleccione</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select><br><br>

    <textarea name="comentario" placeholder="Comentario (opcional)"></textarea><br><br>

    <button type="submit">Enviar reseña</button>
</form>
