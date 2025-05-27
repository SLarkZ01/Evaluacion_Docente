<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Sistema de Evaluación Docente</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at 60% 40%, #60a5fa 0%, #2563eb 60%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #334155;
        }

        .error-container {
            max-width: 800px;
            width: 90%;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 32px;
            box-shadow: 0 8px 32px 0 rgba(31, 41, 55, 0.25);
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(96, 165, 250, 0.25);
            margin: 2rem 0;
        }

        .error-header {
            background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
            padding: 2.5rem 2rem 1.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1.5px solid rgba(96, 165, 250, 0.15);
        }

        .error-header::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -40%;
            width: 180%;
            height: 180%;
            background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        .error-code {
            font-size: 6rem;
            font-weight: 900;
            color: #fff;
            text-shadow: 0 4px 16px rgba(59, 130, 246, 0.25);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .error-title {
            font-size: 1.7rem;
            color: #e0e7ef;
            font-weight: 700;
            position: relative;
            z-index: 2;
            letter-spacing: 0.5px;
        }

        .error-content {
            padding: 2.5rem 2rem 2rem 2rem;
            text-align: center;
        }

        .error-icon {
            width: 100px;
            height: 105px;
            margin: 0 auto 2rem;
            background: linear-gradient(135deg, #dbeafe 0%, #60a5fa 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 2px 12px rgba(59, 130, 246, 0.10);
        }

        .error-icon::before {
            content: '⚠️';
            font-size: 3.5rem;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .error-message {
            font-size: 1.3rem;
            color: #334155;
            margin-bottom: 1.2rem;
            line-height: 1.6;
            font-weight: 600;
        }

        .error-description {
            font-size: 1.05rem;
            color: #475569;
            margin-bottom: 2rem;
            line-height: 1.7;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-steps {
            background: rgba(224, 231, 239, 0.6);
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.05);
        }

        .error-steps h4 {
            color: #2563eb;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .error-steps ol {
            color: #334155;
            padding-left: 1.5rem;
        }

        .error-steps li {
            margin-bottom: 0.5rem;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(.4,2,.3,1);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.08);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
            color: white;
            border: 1.5px solid #2563eb;
        }

        .btn-primary:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.18);
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        }

        .btn-secondary {
            background: white;
            color: #2563eb;
            border: 1.5px solid #60a5fa;
        }

        .btn-secondary:hover {
            background: #e0e7ef;
            color: #1e40af;
            transform: translateY(-2px) scale(1.03);
        }

        .footer-info {
            background: rgba(224, 231, 239, 0.7);
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1.5px solid #e2e8f0;
        }

        .footer-info p {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .university-logo {
            max-height: 60px;
            margin-top: 1rem;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 4rem;
            }
            .error-container {
                width: 98%;
                margin: 1rem;
                border-radius: 18px;
            }
            .error-content {
                padding: 2rem 1.2rem;
            }
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        .loading-dots {
            display: inline-block;
        }

        .loading-dots::after {
            content: '';
            animation: dots 2s infinite;
        }

        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-header">
            <div class="error-code">404</div>
            <h1 class="error-title">Datos Iniciales No Cargados</h1>
        </div>

        <div class="error-content">
            <div class="error-icon">
            </div>

            <div class="error-message">
                Sistema de Evaluación Docente en Configuración Inicial
            </div>

            <div class="error-description">
                Este error se presenta únicamente durante la primera inicialización del sistema. 
                Los datos base necesarios para el funcionamiento del módulo de evaluación docente 
                aún no han sido cargados en la base de datos.
            </div>

            <div class="error-steps">
                <h4>¿Qué significa este error?</h4>
                <ol>
                    <li>Es la primera vez que se ejecuta el sistema desde cero</li>
                    <li>Los datos iniciales (períodos académicos, escalas de evaluación, etc.) no están configurados</li>
                    <li>Una vez configurado el sistema, este error no volverá a aparecer</li>
                    <li>Los usuarios podrán registrarse normalmente después de la configuración inicial</li>
                </ol>
            </div>

            <div class="action-buttons">
                <a href="{{ route('welcome') }}" class="btn btn-secondary">
                    🏠 Volver al Inicio
                </a>
            </div>
        </div>

        <div class="footer-info">
            <p><strong>Corporación Universitaria Autónoma del Cauca</strong></p>
            <p>Sistema de Evaluación Docente - Versión 1.0</p>
            <p class="loading-dots">Configurando datos iniciales</p>
            
        </div>
    </div>

    <script>
        // Efecto de partículas en el fondo (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            // Aquí puedes agregar JavaScript adicional si lo necesitas
            console.log('Error 404: Sistema en configuración inicial');
        });
    </script>
</body>
</html>