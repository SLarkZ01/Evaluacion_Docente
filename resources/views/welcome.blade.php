<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Evaluación Docente - Uniautónoma del Cauca</title>

        <!-- Vite/Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Font Awesome para iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #003366; /* Azul institucional */
                --secondary-color: #FFD700; /* Dorado institucional */
                --accent-color: #CC0000; /* Rojo institucional */
            }
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f5f5f5;
            }
            .bg-primary-custom {
                background-color: var(--primary-color);
            }
            .bg-secondary-custom {
                background-color: var(--secondary-color);
            }
            .text-primary-custom {
                color: var(--primary-color);
            }
            .text-secondary-custom {
                color: var(--secondary-color);
            }
            .border-primary-custom {
                border-color: var(--primary-color);
            }
            .border-secondary-custom {
                border-color: var(--secondary-color);
            }
            .btn-primary-custom {
                background-color: var(--primary-color);
                color: white;
            }
            .btn-primary-custom:hover {
                background-color: #002244;
                color: white;
            }
            .btn-secondary-custom {
                background-color: var(--secondary-color);
                color: var(--primary-color);
            }
            .btn-secondary-custom:hover {
                background-color: #E6C200;
                color: var(--primary-color);
            }
            .hero-section {
                background-image: url({{ asset('/images/FondoUniversidad.png') }});
                background-size: cover;
                background-position: center;
                position: relative;
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 51, 102, 0.8);
                z-index: 1;
            }
            .hero-content {
                position: relative;
                z-index: 2;
            }
            .feature-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
            .alert-box {
                border-left: 4px solid var(--accent-color);
                background-color: #FFEBEE;
                padding: 15px;
                margin: 20px 0;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <header>
            <!-- Navegación -->
            <nav class="bg-primary-custom shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="text-white font-semibold text-lg flex items-center">
                                <img src="{{ asset('/images/LogoUniautonoma.png') }}" alt="Logo Uniautónoma" class="h-10 mr-2">
                                Sistema de Evaluación Docente
                            </a>
                        </div>
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div class="flex items-center space-x-4">
                                    @if (Route::has('login'))
                                        @auth
                                            @php
                                                $dashboardRoute = '/dashboard';
                                                if(auth()->user()->rol) {
                                                    switch(auth()->user()->rol->nombre) {
                                                        case 'Administrador':
                                                            $dashboardRoute = route('Admin.Dashboard');
                                                            break;
                                                        case 'Decano':
                                                            $dashboardRoute = route('user.index');
                                                            break;
                                                        case 'Docente':
                                                            $dashboardRoute = route('docente.p_docente');
                                                            break;
                                                        default:
                                                            $dashboardRoute = route('dashboard');
                                                            break;
                                                    }
                                                }
                                            @endphp
                                            <a href="{{ $dashboardRoute }}" class="text-white hover:text-secondary-custom px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                        @else
                                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-secondary-custom text-white hover:bg-secondary-custom hover:text-primary-custom transition duration-300 text-sm font-medium">Iniciar Sesión</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-secondary-custom text-primary-custom hover:bg-yellow-400 transition duration-300 text-sm font-medium">Registrarse</a>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </div>
                            <div class="md:hidden flex items-center">
                                <button id="mobile-menu-button" class="text-white hover:text-secondary-custom focus:outline-none">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div id="mobile-menu" class="hidden md:hidden bg-primary-custom">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        @if (Route::has('login'))
                            @auth
                                @php
                                    $dashboardRoute = '/dashboard';
                                    if(auth()->user()->rol) {
                                        switch(auth()->user()->rol->nombre) {
                                            case 'Administrador':
                                                $dashboardRoute = route('Admin.Dashboard');
                                                break;
                                            case 'Decano':
                                                $dashboardRoute = route('user.index');
                                                break;
                                            case 'Docente':
                                                $dashboardRoute = route('docente.p_docente');
                                                break;
                                            default:
                                                $dashboardRoute = route('dashboard');
                                                break;
                                        }
                                    }
                                @endphp
                                <a href="{{ $dashboardRoute }}" class="text-white hover:text-secondary-custom block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-secondary-custom block px-3 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-white hover:text-secondary-custom block px-3 py-2 rounded-md text-base font-medium">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>
            
            <!-- Hero Section -->
            <section class="hero-section text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center hero-content">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('/images/escudo.png') }}" alt="Escudo Uniautónoma" class="h-32">
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Sistema de Evaluación Docente</h1>
                    <h2 class="text-2xl md:text-3xl font-semibold mb-4">Corporación Universitaria Autónoma del Cauca</h2>
                    <p class="text-xl mb-10 max-w-3xl mx-auto">Plataforma para la gestión y evaluación del desempeño docente</p>
                    
                    <div class="alert-box mx-auto max-w-3xl mb-8">
                        <h3 class="font-bold text-lg mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Importante</h3>
                        <p>Antes de ingresar al sistema, es necesario cargar el archivo Excel con los datos requeridos para la evaluación docente.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                @php
                                    $dashboardRoute = '/dashboard';
                                    if(auth()->user()->rol) {
                                        switch(auth()->user()->rol->nombre) {
                                            case 'Administrador':
                                                $dashboardRoute = route('Admin.Dashboard');
                                                break;
                                            case 'Decano':
                                                $dashboardRoute = route('user.index');
                                                break;
                                            case 'Docente':
                                                $dashboardRoute = route('docente.p_docente');
                                                break;
                                            default:
                                                $dashboardRoute = route('dashboard');
                                                break;
                                        }
                                    }
                                @endphp
                                <a href="{{ $dashboardRoute }}" class="px-8 py-3 bg-secondary-custom hover:bg-yellow-400 rounded-lg text-primary-custom font-semibold text-lg transition duration-300 shadow-lg">Ir al Dashboard</a>
                            @else
                                <a href="{{ route('cargar-excel') }}" class="px-8 py-3 bg-secondary-custom hover:bg-yellow-400 rounded-lg text-primary-custom font-semibold text-lg transition duration-300 shadow-lg">
                                    <i class="fas fa-file-excel mr-2"></i>Cargar Excel
                                </a>
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-white hover:bg-gray-100 rounded-lg text-primary-custom font-semibold text-lg transition duration-300 shadow-lg">Iniciar Sesión</a>
                            @endif
                        @endif
                    </div>
                </div>
            </section>
        </header>
        
        <main>
            <!-- Características -->
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center mb-12 text-primary-custom">Características del Sistema</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white rounded-xl shadow-md p-6 feature-card border-t-4 border-primary-custom">
                            <div class="text-center">
                                <i class="fas fa-chart-bar text-4xl text-primary-custom mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-primary-custom">Evaluación Integral</h3>
                                <p class="text-gray-600">Sistema completo para la evaluación del desempeño docente, con métricas y criterios establecidos por la institución.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 feature-card border-t-4 border-primary-custom">
                            <div class="text-center">
                                <i class="fas fa-users text-4xl text-primary-custom mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-primary-custom">Roles Específicos</h3>
                                <p class="text-gray-600">Diferentes niveles de acceso para administradores, decanos, coordinadores y docentes, con funcionalidades adaptadas a cada rol.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-6 feature-card border-t-4 border-primary-custom">
                            <div class="text-center">
                                <i class="fas fa-file-alt text-4xl text-primary-custom mb-4"></i>
                                <h3 class="text-xl font-semibold mb-3 text-primary-custom">Informes y Estadísticas</h3>
                                <p class="text-gray-600">Generación de reportes detallados y visualización de estadísticas para el seguimiento y mejora continua del desempeño docente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Proceso de Evaluación -->
            <section class="py-16 bg-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center mb-12 text-primary-custom">Proceso de Evaluación Docente</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-custom">
                            <h3 class="text-xl font-semibold mb-2 text-primary-custom"><span class="text-2xl font-bold text-secondary-custom mr-2">1.</span> Carga de Datos</h3>
                            <p class="text-gray-600">El primer paso es cargar el archivo Excel con la información de docentes, estudiantes y programas académicos para inicializar el sistema.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-custom">
                            <h3 class="text-xl font-semibold mb-2 text-primary-custom"><span class="text-2xl font-bold text-secondary-custom mr-2">2.</span> Evaluación por Estudiantes</h3>
                            <p class="text-gray-600">Los estudiantes realizan la evaluación de sus docentes según los criterios establecidos por la institución.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-custom">
                            <h3 class="text-xl font-semibold mb-2 text-primary-custom"><span class="text-2xl font-bold text-secondary-custom mr-2">3.</span> Análisis de Resultados</h3>
                            <p class="text-gray-600">Decanos y coordinadores analizan los resultados de las evaluaciones para identificar fortalezas y áreas de mejora.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-custom">
                            <h3 class="text-xl font-semibold mb-2 text-primary-custom"><span class="text-2xl font-bold text-secondary-custom mr-2">4.</span> Plan de Mejoramiento</h3>
                            <p class="text-gray-600">Se establecen planes de mejoramiento para los docentes que lo requieran, con seguimiento y apoyo institucional.</p>
                        </div>
                        
                        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-primary-custom">
                            <h3 class="text-xl font-semibold mb-2 text-primary-custom"><span class="text-2xl font-bold text-secondary-custom mr-2">5.</span> Seguimiento Continuo</h3>
                            <p class="text-gray-600">Monitoreo constante del desempeño docente para garantizar la calidad educativa en la institución.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Llamada a la acción -->
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-4 text-primary-custom">¿Listo para comenzar?</h2>
                    <p class="text-xl mb-10 text-gray-600 max-w-3xl mx-auto">Accede al sistema de evaluación docente de la Corporación Universitaria Autónoma del Cauca</p>
                    @if (Route::has('login'))
                        @auth
                            @php
                                $dashboardRoute = '/dashboard';
                                if(auth()->user()->rol) {
                                    switch(auth()->user()->rol->nombre) {
                                        case 'Administrador':
                                            $dashboardRoute = route('Admin.Dashboard');
                                            break;
                                        case 'Decano':
                                            $dashboardRoute = route('user.index');
                                            break;
                                        case 'Docente':
                                            $dashboardRoute = route('docente.p_docente');
                                            break;
                                        default:
                                            $dashboardRoute = route('dashboard');
                                            break;
                                    }
                                }
                            @endphp
                            <a href="{{ $dashboardRoute }}" class="inline-block px-8 py-3 bg-primary-custom hover:bg-blue-900 rounded-lg text-white font-semibold transition duration-300 shadow-md w-full sm:w-auto">Ir al Dashboard</a>
                        @else
                            <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-xs sm:max-w-md mx-auto">
                                <a href="{{ route('cargar-excel') }}" class="px-8 py-3 bg-secondary-custom hover:bg-yellow-400 rounded-lg text-primary-custom font-semibold transition duration-300 shadow-md w-full sm:w-auto">
                                    <i class="fas fa-file-excel mr-2"></i>Cargar Excel
                                </a>
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-primary-custom hover:bg-blue-900 text-white rounded-lg font-semibold transition duration-300 shadow-md w-full sm:w-auto">Iniciar Sesión</a>
                            </div>
                        @endauth
                    @endif
                </div>
            </section>
        </main>
        
        <footer class="bg-primary-custom text-white py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex justify-center items-center mb-4">
                    <img src="{{ asset('/images/LogoUniautonoma.png') }}" alt="Logo Uniautónoma" class="h-10 mr-3">
                    <span class="text-xl font-semibold">Corporación Universitaria Autónoma del Cauca</span>
                </div>
                <p>&copy; {{ date('Y') }} Sistema de Evaluación Docente. Todos los derechos reservados.</p>
            </div>
        </footer>

        <script>
            // Toggle mobile menu
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        </script>
    </body>
</html>
