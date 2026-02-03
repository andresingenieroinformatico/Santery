<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logeado = isset($_SESSION["rol"]);
?>

<nav class="bg-gray-900 text-white shadow-md mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <div class="text-lg font-bold">
            🔮 Santería Online
        </div>

        <div class="space-x-4 text-sm">

            <?php if ($logeado): ?>

                <!-- CLIENTE -->
                <?php if ($_SESSION["rol"] === "cliente"): ?>
                    <a href="/views/dashboard_cliente.php" class="hover:text-green-400">Inicio</a>
                    <a href="/views/services/list.php" class="hover:text-green-400">Servicios</a>
                <?php endif; ?>

                <!-- SANTERO -->
                <?php if ($_SESSION["rol"] === "santero"): ?>
                    <a href="/views/dashboard_santero.php" class="hover:text-purple-400">Inicio</a>
                    <a href="/views/services/create.php" class="hover:text-purple-400">Publicar</a>
                    <a href="/views/services/my_services.php" class="hover:text-purple-400">Mis servicios</a>
                <?php endif; ?>

                <!-- COMÚN A LOGEADOS -->
                <a href="/views/profile/edit.php" class="hover:text-blue-400">Perfil</a>

                <a href="/controllers/logout.php" onclick="return confirm('¿Cerrar sesión?')" class="text-red-400 hover:text-red-600 font-semibold">
                    Salir
                </a>

            <?php else: ?>

                <!-- USUARIOS NO LOGEADOS -->
                <a href="/index.php" class="hover:text-green-400 font-semibold">Inicio</a>
                <a href="/views/auth/lista.php" class="hover:text-green-400 font-semibold">Servicios</a>
                <a href="/views/auth/login.php" class="hover:text-green-400 font-semibold">Iniciar sesión</a>
                <a href="/views/auth/register.php" class="hover:text-green-400 font-semibold">Registrarse</a>

            <?php endif; ?>

        </div>
    </div>
</nav>
