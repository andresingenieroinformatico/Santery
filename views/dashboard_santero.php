<?php
require_once "../middlewares/auth.php";
require_once "../middlewares/role.php";
require_once "../config/database.php";

checkRole("santero");

require_once "../views/layout/menu.php";

/* Total servicios */
$stmt = $pdo->prepare("SELECT COUNT(*) FROM services WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$totalServicios = $stmt->fetchColumn();

/* Total solicitudes */
$stmt = $pdo->prepare(
    "SELECT COUNT(*)
    FROM requests r
    JOIN services s ON r.service_id = s.id
    WHERE s.user_id = ?"
);
$stmt->execute([$_SESSION["user_id"]]);
$totalSolicitudes = $stmt->fetchColumn();
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto px-4">

    <h2 class="text-2xl font-bold mb-2">🔮 Dashboard Santero</h2>
    <p class="text-gray-600 mb-6">
        Bienvenido, <strong><?= htmlspecialchars($_SESSION["nombre"]) ?></strong>
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h5 class="text-lg font-semibold mb-2">📌 Servicios publicados</h5>
            <div class="text-4xl font-bold text-purple-600">
                <?= $totalServicios ?>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h5 class="text-lg font-semibold mb-2">📩 Solicitudes recibidas</h5>
            <div class="text-4xl font-bold text-purple-600">
                <?= $totalSolicitudes ?>
            </div>
        </div>

    </div>
</div>
