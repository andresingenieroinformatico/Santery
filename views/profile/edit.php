<?php
require_once "../../middlewares/auth.php";
require_once "../../middlewares/role.php";
require_once "../../config/database.php";
require_once "../layout/menu.php";

$user_id = $_SESSION["user_id"];

/* Obtener datos del usuario */
$stmt = $pdo->prepare("SELECT nombre, email, rol, whatsapp FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die("Usuario no encontrado");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white p-6 rounded-xl shadow-md max-w-md mx-auto">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
            Editar perfil
        </h2>

        <form action="../../controllers/profile/update.php" method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" required
                    value="<?= htmlspecialchars($user["nombre"]) ?>"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    value="<?= htmlspecialchars($user["email"]) ?>"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
            </div>

            <?php if ($user["rol"] === "santero"): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        WhatsApp (con código país)
                    </label>
                    <input type="text" name="whatsapp"
                        placeholder="573001234567"
                        value="<?= htmlspecialchars($user["whatsapp"]) ?>"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
                </div>
            <?php endif; ?>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Guardar cambios
            </button>
        </form>

        <a href="../../views/dashboard_santero.php"
        class="block text-center mt-4 text-blue-600 hover:underline">
            ← Volver
        </a>

    </div>
</div>

</body>
</html>
