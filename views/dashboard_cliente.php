<?php
require_once "../middlewares/auth.php";
require_once "../middlewares/role.php";
require_once "../config/database.php";


checkRole("cliente");

require_once "../views/layout/menu.php";
// Total solicitudes
$stmt = $pdo->prepare(
    "SELECT COUNT(*) FROM requests WHERE cliente_id = ?"
);
$stmt->execute([$_SESSION["user_id"]]);
$totalSolicitudes = $stmt->fetchColumn();

// Solicitudes pendientes
$stmt = $pdo->prepare(
    "SELECT COUNT(*) FROM requests 
    WHERE cliente_id = ? AND estado = 'pendiente'"
);
$stmt->execute([$_SESSION["user_id"]]);
$pendientes = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto p-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-1">
        👤 Dashboard Cliente
    </h2>
    <p class="text-gray-600 mb-6">
        Bienvenido, <strong><?= htmlspecialchars($_SESSION["nombre"]) ?></strong>
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h3 class="text-gray-700 font-medium mb-2">
                📩 Solicitudes enviadas
            </h3>
            <p class="text-3xl font-bold text-blue-600">
                <?= $totalSolicitudes ?>
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h3 class="text-gray-700 font-medium mb-2">
                ⏳ Solicitudes pendientes
            </h3>
            <p class="text-3xl font-bold text-yellow-500">
                <?= $pendientes ?>
            </p>
        </div>

    </div>

</div>

</body>
</html>
