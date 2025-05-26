<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Evaluación Docente') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .auth-gradient {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            }
            .auth-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .university-pattern {
                background-image: url('{{ asset('images/FondoUniversidad.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen auth-gradient university-pattern flex flex-col justify-center items-center px-4">
            <!-- Header con logo -->
            <div class="mb-8 text-center">
                <div class="flex justify-center items-center mb-4">
                    <img src="{{ asset('images/LogoUniautonoma.png') }}" alt="Universidad Autónoma" class="h-16 w-auto mr-4">
                    {{-- <img src="{{ asset('images/escudo.png') }}" alt="Escudo" class="h-16 w-auto"> --}}
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Sistema de Evaluación Docente</h1>
                <p class="text-blue-100">Universidad Autónoma del Cauca</p>
            </div>

            <!-- Card principal -->
            <div class="w-full max-w-md auth-card shadow-2xl rounded-2xl p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-blue-100 text-sm">
                <p>&copy; {{ date('Y') }} Universidad Autónoma del Cauca. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
</html>
