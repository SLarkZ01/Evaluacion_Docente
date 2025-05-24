<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Gestión de Publicaciones</title>

        <!-- Vite/Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Font Awesome para iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="font-poppins bg-gray-50">
        <header>
            <!-- Navegación -->
            <nav class="bg-gray-800 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="text-white font-semibold text-lg flex items-center">
                                <i class="fas fa-book-open mr-2"></i>Sistema de Gestión de Publicaciones
                            </a>
                        </div>
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div class="flex items-center space-x-4">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                        @else
                                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-white text-white hover:bg-white hover:text-gray-800 transition duration-300 text-sm font-medium">Iniciar Sesión</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-white text-gray-800 hover:bg-gray-200 transition duration-300 text-sm font-medium">Registrarse</a>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </div>
                            <div class="md:hidden flex items-center">
                                <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>
            
            <!-- Hero Section -->
            <section class="bg-gradient-to-r from-primary-400 to-primary-600 text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Bienvenid@ al Sistema de Gestión de Publicaciones</h1>
                    <p class="text-xl mb-10 max-w-3xl mx-auto">Una plataforma completa para crear, administrar y organizar tus publicaciones de manera eficiente</p>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-secondary-400 hover:bg-secondary-500 rounded-lg text-white font-semibold text-lg transition duration-300 shadow-lg">Ir al Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-secondary-400 hover:bg-secondary-500 rounded-lg text-white font-semibold text-lg transition duration-300 shadow-lg">Comenzar Ahora</a>
                        @endif
                    @endif
                </div>
            </section>
        </header>
        
        <main>
            <!-- Características -->
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Características Principales</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white rounded-xl shadow-md p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-center">
                                <i class="fas fa-edit text-4xl text-primary-400 mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-gray-800">Gestión de Publicaciones</h3>
                                <p class="text-gray-600">Crea, edita y organiza tus publicaciones con facilidad. Añade contenido multimedia y personaliza su presentación.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-center">
                                <i class="fas fa-users text-4xl text-primary-400 mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-gray-800">Roles y Permisos</h3>
                                <p class="text-gray-600">Administra el acceso de usuarios con diferentes niveles de permisos para gestionar el contenido.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-center">
                                <i class="fas fa-chart-line text-4xl text-primary-400 mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-gray-800">Estadísticas y Reportes</h3>
                                <p class="text-gray-600">Visualiza estadísticas detalladas sobre tus publicaciones y genera informes personalizados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Cómo funciona -->
            <section class="py-16 bg-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">¿Cómo Usar el Sistema?</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-400">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800"><span class="text-2xl font-bold text-primary-400 mr-2">1.</span> Crear una Cuenta</h3>
                            <p class="text-gray-600">Regístrate para acceder a todas las funcionalidades del sistema. Solo necesitas proporcionar tu correo electrónico y crear una contraseña.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-400">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800"><span class="text-2xl font-bold text-primary-400 mr-2">2.</span> Acceder al Dashboard</h3>
                            <p class="text-gray-600">Una vez registrado, accede al panel de control donde encontrarás todas las herramientas necesarias para gestionar tus publicaciones.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-400">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800"><span class="text-2xl font-bold text-primary-400 mr-2">3.</span> Crear Publicaciones</h3>
                            <p class="text-gray-600">Utiliza el editor integrado para crear nuevas publicaciones. Puedes añadir texto, por el momento solo puedes añadir texto.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-400">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800"><span class="text-2xl font-bold text-primary-400 mr-2">4.</span> Administrar Categorías</h3>
                            <p class="text-gray-600">Organiza tus publicaciones en categorías para facilitar su búsqueda y visualización. Crea nuevas categorías según tus necesidades.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-400">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800"><span class="text-2xl font-bold text-primary-400 mr-2">5.</span> Visualizar Estadísticas</h3>
                            <p class="text-gray-600">Accede a informes detallados sobre el rendimiento de tus publicaciones, interacciones y otros datos relevantes.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Llamada a la acción -->
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-4 text-gray-800">¿Listo para comenzar?</h2>
                    <p class="text-xl mb-10 text-gray-600 max-w-3xl mx-auto">Únete a mi plataforma y empieza a gestionar tus publicaciones de manera eficiente</p>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 bg-primary-400 hover:bg-primary-500 rounded-lg text-white font-semibold transition duration-300 shadow-md w-full sm:w-auto">Ir al Dashboard</a>
                        @else
                            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-xs sm:max-w-md mx-auto">
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-primary-400 hover:bg-primary-500 rounded-lg text-white font-semibold transition duration-300 shadow-md w-full sm:w-auto">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-8 py-3 border border-primary-400 text-primary-400 hover:bg-primary-400 hover:text-white rounded-lg font-semibold transition duration-300 shadow-md w-full sm:w-auto">Registrarse</a>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>
            </section>
        </main>
        
        <footer class="bg-primary-400 text-white py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} Sistema de Gestión de Publicaciones. Derechos por Thomas Montoya Magon</p>
            </div>
        </footer>
    </body>
</html>
