<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md min-h-screen p-5">
            <h1 class="text-2xl font-bold mb-10 text-center">Admin Panel</h1>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.categorias.index') }}" 
                           class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('admin.categorias.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                            Categorías
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.productos.index') }}" 
                           class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('admin.productos.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pedidos.index') }}" 
                           class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('admin.pedidos.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                            Pedidos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.proyectos.index') }}" 
                           class="block py-2 px-4 hover:bg-blue-50 rounded {{ request()->routeIs('admin.proyectos.*') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
                            Proyectos
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>