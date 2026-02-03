<?php require_once "../layout/menu.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="grid md:grid-cols-1">
                <div class="p-8 md:p-10">
                    <span class="inline-block text-xs uppercase tracking-wider text-purple-600 font-semibold">Plataforma</span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Bienvenido a Santeria</h1>
                    <p class="text-gray-600 mt-4 leading-relaxed">Conecta con profesionales, agenda servicios y da seguimiento a tus solicitudes desde un solo lugar.</p>
                    <ul class="mt-6 space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-purple-600"></span>
                            <span>Perfiles claros y procesos de atencion simples.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-purple-600"></span>
                            <span>Historial de solicitudes y seguimiento en tiempo real.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-purple-600"></span>
                            <span>Opciones para clientes y santeros en un mismo espacio.</span>
                        </li>
                    </ul>
                    <div class="mt-6 rounded-lg border border-gray-200 p-4 text-sm text-gray-600">
                        <p class="font-semibold text-gray-800">Que puedes hacer aqui</p>
                        <ul class="mt-2 space-y-1">
                            <li>Crear y publicar servicios si eres santero.</li>
                            <li>Buscar, reservar y gestionar servicios si eres cliente.</li>
                            <li>Recibir notificaciones y soporte dentro de la plataforma.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
