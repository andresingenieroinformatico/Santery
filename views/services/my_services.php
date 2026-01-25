<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";
require_once "../layout/menu.php";

checkRole("santero");

$stmt = $pdo->prepare("SELECT * FROM services WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis servicios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Mis servicios</h2>

        <a href="create.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Nuevo servicio</a>
    </div>

    <!-- Lista de servicios -->
    <?php if (count($services) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($services as $service): ?>
                <div class="bg-white rounded-xl shadow-md p-5">

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        <?= htmlspecialchars($service["titulo"]) ?>
                    </h3>

                    <p class="text-gray-600 mb-3">
                        <?= htmlspecialchars($service["descripcion"]) ?>
                    </p>

                    <div class="text-sm text-gray-700 space-y-1 mb-4">
                        <p>💲 <span class="font-medium"><?= $service["precio"] ?></span></p>
                        <p>📌 <?= ucfirst($service["modalidad"]) ?></p>
                        <p>🔮 <?= htmlspecialchars($service["categoria"]) ?></p>
                    </div>

                    <div class="flex gap-3">
                        <a href="edit.php?id=<?= $service["id"] ?>"
                        class="text-blue-600 hover:underline">
                            Editar
                        </a>

                        <a href="../../controllers/services/delete.php?id=<?= $service["id"] ?>"
                        onclick="return confirm('¿Eliminar servicio?')"
                        class="text-red-600 hover:underline">
                            Eliminar
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">
            Aún no has publicado servicios.
        </div>
    <?php endif; ?>

</div>

</body>
</html>
