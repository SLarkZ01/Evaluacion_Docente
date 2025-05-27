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
                position: relative;
                overflow: hidden;
            }
            
            .auth-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                position: relative;
                z-index: 10;
            }
            
            .university-pattern {
                background-image: url('{{ asset('images/FondoUniversidad.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }
            
            .university-pattern::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: inherit;
                filter: blur(3px);
                z-index: 1;
            }
            
            .university-pattern::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(30, 58, 138, 0.4);
                z-index: 2;
            }
            
            .content-wrapper {
                position: relative;
                z-index: 5;
            }
            
            /* Animación de burbujas */
            .bubbles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 3;
            }
            
            .bubble {
                position: absolute;
                bottom: -100px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                opacity: 0.6;
                animation: rise 15s infinite ease-in;
            }
            
            .bubble:nth-child(1) {
                width: 40px;
                height: 40px;
                left: 10%;
                animation-duration: 12s;
                animation-delay: 0s;
            }
            
            .bubble:nth-child(2) {
                width: 20px;
                height: 20px;
                left: 20%;
                animation-duration: 15s;
                animation-delay: 2s;
            }
            
            .bubble:nth-child(3) {
                width: 50px;
                height: 50px;
                left: 35%;
                animation-duration: 18s;
                animation-delay: 4s;
            }
            
            .bubble:nth-child(4) {
                width: 80px;
                height: 80px;
                left: 50%;
                animation-duration: 20s;
                animation-delay: 0s;
            }
            
            .bubble:nth-child(5) {
                width: 35px;
                height: 35px;
                left: 55%;
                animation-duration: 14s;
                animation-delay: 3s;
            }
            
            .bubble:nth-child(6) {
                width: 45px;
                height: 45px;
                left: 65%;
                animation-duration: 16s;
                animation-delay: 6s;
            }
            
            .bubble:nth-child(7) {
                width: 25px;
                height: 25px;
                left: 75%;
                animation-duration: 13s;
                animation-delay: 7s;
            }
            
            .bubble:nth-child(8) {
                width: 60px;
                height: 60px;
                left: 80%;
                animation-duration: 19s;
                animation-delay: 2s;
            }
            
            .bubble:nth-child(9) {
                width: 30px;
                height: 30px;
                left: 90%;
                animation-duration: 17s;
                animation-delay: 5s;
            }
            
            .bubble:nth-child(10) {
                width: 55px;
                height: 55px;
                left: 15%;
                animation-duration: 21s;
                animation-delay: 8s;
            }
            
            @keyframes rise {
                0% {
                    bottom: -100px;
                    transform: translateX(0);
                    opacity: 0;
                }
                
                10% {
                    opacity: 0.6;
                }
                
                50% {
                    transform: translateX(50px);
                }
                
                90% {
                    opacity: 0.6;
                }
                
                100% {
                    bottom: 100vh;
                    transform: translateX(-50px);
                    opacity: 0;
                }
            }
            
            /* Efecto de glassmorphism mejorado */
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            }
            
            /* Animación sutil para el contenido */
            .fade-in {
                animation: fadeIn 1s ease-in-out;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen auth-gradient university-pattern flex flex-col justify-center items-center px-4">
            <!-- Burbujas animadas -->
            <div class="bubbles">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
            </div>
            
            <!-- Contenido principal -->
            <div class="content-wrapper fade-in">
                <!-- Header con logo -->
                <div class="mb-8 text-center">
                    <div class="flex justify-center items-center mb-4">
                        <a href="{{ route('welcome') }}" class="hover:opacity-80 transition-opacity">
                            <img src="{{ asset('images/logoblanco.png') }}" alt="Escudo" class="h-16 w-auto">
                        </a>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-2 drop-shadow-lg">Sistema de Evaluación Docente</h1>
                    <p class="text-blue-100 drop-shadow">Universidad Autónoma del Cauca</p>
                </div>

                <!-- Card principal -->
                <div class="w-full max-w-md auth-card shadow-2xl rounded-2xl p-8">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    {{ $slot }}
                </div>
                
                <!-- Footer -->
                <div class="mt-8 text-center text-blue-100 text-sm drop-shadow">
                    <p>&copy; {{ date('Y') }} Universidad Autónoma del Cauca. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </body>
</html>