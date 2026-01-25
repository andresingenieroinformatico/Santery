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
    <title>Publicar Servicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md mx-auto">

            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">
                Publicar servicio
            </h2>

            <form action="../../controllers/services/store.php" method="POST" class="space-y-4">
                <input type="text" name="titulo" placeholder="Título del servicio" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">

                <textarea name="descripcion" placeholder="Descripción" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600"></textarea>

                <input type="number" step="0.01" name="precio" placeholder="Precio" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">

                <select name="modalidad" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
                    <option value="">Modalidad</option>
                    <option value="virtual">Virtual</option>
                    <option value="presencial">Presencial</option>
                </select>

                <input type="text" name="categoria" placeholder="Categoría" required
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Publicar
                </button>
            </form>

            <a href="my_services.php" class="block text-center mt-4 text-blue-600 hover:underline">
                Ver mis servicios
            </a>

        </div>
    </div>

</body>

</html>