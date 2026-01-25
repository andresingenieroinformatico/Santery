<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";
require_once "../layout/menu.php";

checkRole("cliente");

// Filtros
$categoria = $_GET["categoria"] ?? "";
$modalidad = $_GET["modalidad"] ?? "";
$precioMax = $_GET["precio_max"] ?? "";

// Query base
$sql = "SELECT s.*, u.nombre AS santero
        FROM services s
        JOIN users u ON s.user_id = u.id
        WHERE 1=1";

$params = [];

// Filtros dinámicos
if ($categoria !== "") {
    $sql .= " AND s.categoria LIKE ?";
    $params[] = "%$categoria%";
}

if ($modalidad !== "") {
    $sql .= " AND s.modalidad = ?";
    $params[] = $modalidad;
}

if ($precioMax !== "") {
    $sql .= " AND s.precio <= ?";
    $params[] = $precioMax;
}

$sql .= " ORDER BY s.fecha_creacion DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto p-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">
        🔍 Buscar servicios
    </h2>

    <!-- Filtros -->
    <form method="GET" class="bg-white p-4 rounded-xl shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">

        <input type="text" name="categoria" placeholder="Categoría"
            value="<?= htmlspecialchars($categoria) ?>"
            class="p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">

        <select name="modalidad"
            class="p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
            <option value="">Modalidad</option>
            <option value="virtual" <?= $modalidad=="virtual"?"selected":"" ?>>Virtual</option>
            <option value="presencial" <?= $modalidad=="presencial"?"selected":"" ?>>Presencial</option>
        </select>

        <input type="number" step="0.01" name="precio_max" placeholder="Precio máximo"
            value="<?= htmlspecialchars($precioMax) ?>"
            class="p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">

        <button type="submit"
            class="bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Buscar
        </button>
    </form>

    <!-- Resultados -->
    <h2 class="text-xl font-semibold text-gray-800 mb-4">
        Servicios encontrados
    </h2>

    <?php if (count($services) === 0): ?>
        <p class="text-gray-600">No se encontraron servicios.</p>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($services as $service): ?>
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    <?= htmlspecialchars($service["titulo"]) ?>
                </h3>

                <p class="text-gray-600 text-sm mb-2">
                    <?= htmlspecialchars(substr($service["descripcion"], 0, 120)) ?>...
                </p>

                <p class="text-sm">🔮 <?= htmlspecialchars($service["categoria"]) ?></p>
                <p class="text-sm">📌 <?= $service["modalidad"] ?></p>
                <p class="text-sm font-semibold">💲 <?= $service["precio"] ?></p>
                <p class="text-sm text-gray-700">👤 <?= htmlspecialchars($service["santero"]) ?></p>

                <a href="detail.php?id=<?= $service["id"] ?>"
                class="block mt-3 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Ver detalle
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
