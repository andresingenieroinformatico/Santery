<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center mb-6">Crear cuenta</h2>

    <form action="../../controllers/register.php" method="POST" class="space-y-4">

        <input type="text" name="nombre" placeholder="Nombre completo" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">

        <input type="email" name="email" placeholder="Correo electrónico" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">

        <input type="password" name="password" placeholder="Contraseña" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">

        <select name="rol" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
            <option value="">Selecciona tu rol</option>
            <option value="santero">Santero</option>
            <option value="cliente">Cliente</option>
        </select>

        <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
            Registrarse
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
        ¿Ya tienes cuenta?
        <a href="login.php" class="text-purple-600 hover:underline">Inicia sesión</a>
    </p>
</div>

</body>
</html>
