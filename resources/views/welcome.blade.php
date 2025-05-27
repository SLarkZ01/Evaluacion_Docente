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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            /* Azul moderno */
            --primary-dark: #1e3a8a;
            --secondary-color: #f59e0b;
            /* Amarillo/dorado moderno */
            --secondary-dark: #d97706;
            --accent-color: #dc2626;
            /* Rojo moderno */
            --success-color: #059669;
            --gradient-primary: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            --gradient-secondary: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-hero: linear-gradient(135deg, rgba(30, 64, 175, 0.95) 0%, rgba(59, 130, 246, 0.9) 100%);
        }

        /* Media queries para ajustes responsive */
        @media (max-width: 640px) {

            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
                margin-bottom: 1rem;
            }

            .feature-card {
                margin-left: 1rem;
                margin-right: 1rem;
            }
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .bg-primary-custom {
            background: var(--gradient-primary);
        }

        .bg-secondary-custom {
            background: var(--gradient-secondary);
        }

        .text-primary-custom {
            color: var(--primary-color);
        }

        .text-secondary-custom {
            color: var(--secondary-color);
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            color: white;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.4);
            color: white;
        }

        .btn-secondary-custom {
            background: var(--gradient-secondary);
            color: white;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.7) 0%, rgba(59, 130, 246, 0.6) 100%), url({{ asset('/images/FondoUniversidad.png') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(3px);
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite;
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            pointer-events: none;
            z-index: 1;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(245, 158, 11, 0.5);
            }

            50% {
                box-shadow: 0 0 30px rgba(245, 158, 11, 0.8);
            }
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(30, 64, 175, 0.1), transparent);
            transition: all 0.6s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .alert-excel {
            background: linear-gradient(135deg, rgba(254, 243, 199, 0.95) 0%, rgba(253, 230, 138, 0.95) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid #f59e0b;
            border-radius: 16px;
            padding: 24px;
            margin: 32px auto;
            max-width: 600px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
            animation: pulse-glow 2s infinite;
        }

        .alert-excel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .alert-excel-content {
            position: relative;
            z-index: 2;
        }

        .process-step {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-left: 5px solid var(--primary-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .process-step::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(30, 64, 175, 0.05), transparent);
            transition: all 0.5s;
        }

        .process-step:hover::before {
            left: 100%;
        }

        .process-step:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-left-color: var(--secondary-color);
        }

        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        }

        .hero-text-enhanced {
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            font-weight: 600;
        }

        .nav-link {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: var(--gradient-secondary);
            transition: all 0.3s ease;
        }

        .nav-link:hover::before {
            left: 0;
        }

        .cta-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            position: relative;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(30, 64, 175, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .section-divider {
            height: 4px;
            background: var(--gradient-primary);
            margin: 0 auto;
            border-radius: 2px;
            width: 60px;
        }
    </style>
</head>

<body>
    <header>
        <!-- Navegación mejorada -->
        <nav class="bg-primary-custom shadow-2xl relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}"
                            class="text-white font-bold text-xl flex items-center hover:scale-105 transition-transform">
                            <img src="{{ asset('images/logoblanco.png') }}" alt="Logo Uniautónoma"
                                class="h-12 mr-3">
                            <span class="hidden sm:inline">Sistema de Evaluación Docente</span>
                            <span class="sm:hidden">Evaluación Docente</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="hidden md:block">
                            <div class="flex items-center space-x-6">
                                @if (Route::has('login'))
                                    @auth
                                        @php
                                            $dashboardRoute = '/dashboard';
                                            if (auth()->user()->rol) {
                                                switch (auth()->user()->rol->nombre) {
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
                                        <a href="{{ $dashboardRoute }}"
                                            class="nav-link px-4 py-2 text-white hover:text-yellow-300 font-medium transition-all">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="px-6 py-3 rounded-xl border-2 border-white text-white hover:bg-white hover:text-blue-600 transition-all duration-300 font-medium">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="btn-secondary-custom px-6 py-3 rounded-xl font-medium">
                                                <i class="fas fa-user-plus mr-2"></i>Registrarse
                                            </a>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </div>
                        <div class="md:hidden flex items-center">
                            <button id="mobile-menu-button"
                                class="text-white hover:text-yellow-300 focus:outline-none p-2">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu mejorado -->
            <div id="mobile-menu" class="hidden md:hidden bg-primary-custom border-t border-blue-400">
                <div class="px-4 pt-4 pb-6 space-y-3">
                    @if (Route::has('login'))
                        @auth
                            @php
                                $dashboardRoute = '/dashboard';
                                if (auth()->user()->rol) {
                                    switch (auth()->user()->rol->nombre) {
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
                            <a href="{{ $dashboardRoute }}"
                                class="block px-4 py-3 rounded-lg text-white hover:bg-blue-700 font-medium transition-all">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block px-4 py-3 rounded-lg text-white hover:bg-blue-700 font-medium transition-all">
                                <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="block px-4 py-3 rounded-lg text-white hover:bg-blue-700 font-medium transition-all">
                                    <i class="fas fa-user-plus mr-2"></i>Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section mejorado -->
        <section class="hero-section text-white py-24 md:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center hero-content">
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <img src="{{ asset('/images/escudo.png') }}" alt="Escudo Uniautónoma"
                            class="h-36 md:h-40 floating-icon">
                        <div class="absolute inset-0 bg-white opacity-20 rounded-full blur-xl"></div>
                    </div>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-4 sm:mb-6 leading-tight px-4">
                    Sistema de <span class="text-yellow-300">Evaluación</span> Docente
                </h1>

                <h2
                    class="text-xl sm:text-2xl md:text-3xl font-semibold mb-4 sm:mb-6 text-blue-100 hero-text-enhanced px-4">
                    Corporación Universitaria Autónoma del Cauca
                </h2>

                <p
                    class="text-lg sm:text-xl md:text-2xl mb-8 sm:mb-12 max-w-4xl mx-auto text-blue-100 leading-relaxed hero-text-enhanced px-4">
                    Plataforma moderna para la gestión integral y evaluación del desempeño docente
                </p>

                <!-- Alerta de Excel rediseñada -->
                <div class="alert-excel mx-4 sm:mx-auto">
                    <div class="alert-excel-content">
                        <div class="flex items-center justify-center mb-4">
                            <div class="bg-orange-500 rounded-full p-2 sm:p-3 mr-2 sm:mr-4">
                                <i class="fas fa-file-excel text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl sm:text-2xl text-orange-900">
                                ¡Paso Importante!
                            </h3>
                        </div>
                        <p class="text-base sm:text-lg text-orange-800 font-medium leading-relaxed px-2 sm:px-0">
                            Para comenzar a usar el sistema, primero necesitas cargar el archivo Excel con los datos de
                            docentes, estudiantes y programas académicos.
                        </p>
                        <div class="mt-4 sm:mt-6 flex justify-center">
                            <div
                                class="inline-flex items-center px-3 sm:px-4 py-2 bg-orange-500 text-white rounded-full text-xs sm:text-sm font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Requisito obligatorio para el funcionamiento
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción mejorados -->
                <div class="flex flex-col sm:flex-row justify-center gap-6 mt-12">
                    <a href="{{ route('cargar-excel') }}"
                        class="btn-secondary-custom px-10 py-4 rounded-2xl font-bold text-lg transition-all transform hover:scale-105">
                        <i class="fas fa-file-excel mr-3"></i>Cargar Archivo Excel
                    </a>
                    @if (Route::has('login'))
                        @auth
                            @php
                                $dashboardRoute = '/dashboard';
                                if (auth()->user()->rol) {
                                    switch (auth()->user()->rol->nombre) {
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
                            <a href="{{ $dashboardRoute }}"
                                class="btn-secondary-custom px-10 py-4 rounded-2xl font-bold text-lg transition-all transform hover:scale-105">
                                <i class="fas fa-tachometer-alt mr-3"></i>Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="glass-card px-10 py-4 rounded-2xl text-white font-bold text-lg transition-all transform hover:scale-105 hover:bg-white hover:text-blue-600">
                                <i class="fas fa-sign-in-alt mr-3"></i>Iniciar Sesión
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    </header>

    <main>
        <!-- Características mejoradas -->
        <section class="py-12 sm:py-20 bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold gradient-text mb-4">
                        Características del Sistema
                    </h2>
                    <div class="section-divider mb-6 sm:mb-8"></div>
                    <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-2">
                        Una plataforma completa diseñada para optimizar el proceso de evaluación docente
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    <div class="feature-card rounded-2xl shadow-xl p-6 sm:p-8 border-t-4 border-blue-500">
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-full w-16 sm:w-20 h-16 sm:h-20 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                                <i class="fas fa-chart-bar text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800">Evaluación Integral
                            </h3>
                            <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                                Sistema completo con métricas avanzadas y criterios establecidos institucionalmente para
                                una evaluación objetiva y detallada.
                            </p>
                        </div>
                    </div>

                    <div class="feature-card rounded-2xl shadow-xl p-8 border-t-4 border-amber-500">
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-users text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">Roles Específicos</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Diferentes niveles de acceso personalizados para administradores, decanos, coordinadores
                                y docentes con funcionalidades adaptadas.
                            </p>
                        </div>
                    </div>

                    <div class="feature-card rounded-2xl shadow-xl p-8 border-t-4 border-emerald-500">
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-file-alt text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">Informes Avanzados</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Generación automática de reportes detallados con visualizaciones interactivas para el
                                seguimiento y mejora continua.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Llamada a la acción mejorada -->
        <section class="cta-section py-12 sm:py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <div class="mb-8 sm:mb-12">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold gradient-text mb-4 sm:mb-6">
                        ¿Listo para Comenzar?
                    </h2>
                    <div class="section-divider mb-6 sm:mb-8"></div>
                    <p class="text-lg sm:text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed px-2">
                        Únete al futuro de la evaluación docente con nuestra plataforma innovadora de la Corporación
                        Universitaria Autónoma del Cauca
                    </p>
                </div>

                <div
                    class="bg-white rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl p-6 sm:p-8 md:p-12 max-w-4xl mx-auto">
                    @if (Route::has('login'))
                        @auth
                            @php
                                $dashboardRoute = '/dashboard';
                                if (auth()->user()->rol) {
                                    switch (auth()->user()->rol->nombre) {
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
                            <div class="text-center">
                                <div
                                    class="bg-green-100 rounded-full w-16 sm:w-20 h-16 sm:h-20 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                                    <i class="fas fa-check text-2xl sm:text-3xl text-green-600"></i>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">¡Bienvenido de nuevo!
                                </h3>
                                <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">Accede a tu panel de control
                                    personalizado</p>
                                <a href="{{ $dashboardRoute }}"
                                    class="btn-primary-custom px-8 sm:px-12 py-3 sm:py-4 rounded-xl sm:rounded-2xl font-bold text-lg sm:text-xl inline-block">
                                    <i class="fas fa-tachometer-alt mr-3"></i>Ir al Dashboard
                                </a>
                            </div>
                        @else
                            <div class="grid md:grid-cols-2 gap-8 items-center">
                                <div class="text-center md:text-left">
                                    <div
                                        class="bg-orange-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto md:mx-0 mb-6">
                                        <i class="fas fa-file-excel text-3xl text-orange-600"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Paso 1: Cargar Datos</h3>
                                    <p class="text-gray-600 mb-6">Comienza cargando el archivo Excel con la información
                                        necesaria</p>
                                    <a href="{{ route('cargar-excel') }}"
                                        class="btn-secondary-custom px-8 py-3 rounded-xl font-bold text-lg inline-block w-full md:w-auto">
                                        <i class="fas fa-file-excel mr-2"></i>Cargar Excel
                                    </a>
                                </div>

                                <div class="text-center md:text-left">
                                    <div
                                        class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto md:mx-0 mb-6">
                                        <i class="fas fa-sign-in-alt text-3xl text-blue-600"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Paso 2: Iniciar Sesión</h3>
                                    <p class="text-gray-600 mb-6">Accede con tus credenciales para comenzar a usar el
                                        sistema</p>
                                    <a href="{{ route('login') }}"
                                        class="btn-primary-custom px-8 py-3 rounded-xl font-bold text-lg inline-block w-full md:w-auto">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                                    </a>
                                </div>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </section>
    </main>

    <!-- Footer mejorado -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex flex-col sm:flex-row justify-center items-center mb-6 sm:mb-8">
                    <img src="{{ asset('images/logoblanco.png') }}" alt="Logo Uniautónoma"
                        class="h-18 sm:h-20 mb-4 sm:mb-0 sm:mr-4">
                    <div class="text-center sm:text-left">
                        <h3 class="text-xl sm:text-2xl font-bold">Corporación Universitaria Autónoma del Cauca</h3>
                        <p class="text-gray-300 text-sm sm:text-base">Sistema de Evaluación Docente</p>
                    </div>
                </div>

                <div class="border-t border-gray-700 pt-8">
                    <p class="text-gray-300">
                        &copy; {{ date('Y') }} Sistema de Evaluación Docente. Todos los derechos reservados.
                    </p>
                    <p class="text-gray-400 mt-2">
                        Desarrollado con <i class="fas fa-heart text-red-500"></i> para la excelencia educativa
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Animación suave para cards al hacer scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observeCards = () => {
                const cards = document.querySelectorAll('.feature-card, .process-step');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        };
        observeCards();
    });
    </script>
</body>

</html>
