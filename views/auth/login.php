<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center mb-6">Iniciar sesión</h2>

    <form action="../../controllers/login.php" method="POST" class="space-y-4">
        <input type="email" name="email" placeholder="Correo"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">

        <input type="password" name="password" placeholder="Contraseña"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">

        <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
            Entrar
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
        ¿No tienes cuenta?
        <a href="register.php" class="text-purple-600 hover:underline">Crear cuenta</a>
    </p>
</div>

</body>
</html>
