<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Excel - Sistema de Evaluación Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --accent-blue: #60a5fa;
            --dark-blue: #1e3a8a;
        }

        body {
            background: linear-gradient(135deg, #1254a0 0%, #237bd3 25%, #3982c2 50%, #2196f3 75%, #42a5f5 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animaciones de fondo */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .excel-icon {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .excel-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            font-size: 2rem;
            animation-delay: 0s;
        }

        .excel-icon:nth-child(2) {
            top: 20%;
            right: 15%;
            font-size: 1.5rem;
            animation-delay: 1s;
        }

        .excel-icon:nth-child(3) {
            bottom: 30%;
            left: 5%;
            font-size: 2.5rem;
            animation-delay: 2s;
        }

        .excel-icon:nth-child(4) {
            top: 60%;
            right: 10%;
            font-size: 1.8rem;
            animation-delay: 3s;
        }

        .excel-icon:nth-child(5) {
            bottom: 15%;
            right: 25%;
            font-size: 2.2rem;
            animation-delay: 4s;
        }

        .excel-icon:nth-child(6) {
            top: 40%;
            left: 3%;
            font-size: 1.6rem;
            animation-delay: 5s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Partículas flotantes */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particle-float 8s linear infinite;
        }

        .particle:nth-child(7) {
            width: 4px;
            height: 4px;
            left: 20%;
            animation-duration: 8s;
            animation-delay: 0s;
        }

        .particle:nth-child(8) {
            width: 6px;
            height: 6px;
            left: 70%;
            animation-duration: 10s;
            animation-delay: 2s;
        }

        .particle:nth-child(9) {
            width: 3px;
            height: 3px;
            left: 50%;
            animation-duration: 12s;
            animation-delay: 4s;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }

        /* Contenedor principal */
        .container {
            position: relative;
            z-index: 10;
        }

        /* Estilos de la tarjeta */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s ease-out;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .card-header i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Formulario */
        .form-floating {
            position: relative;
        }

        .form-select, .form-control {
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .form-label {
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        /* Botones */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.3);
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
        }

        .btn-outline-secondary {
            border: 2px solid var(--accent-blue);
            color: var(--primary-blue);
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--light-blue);
            border-color: var(--secondary-blue);
            color: var(--dark-blue);
            transform: translateY(-2px);
        }

        /* Alertas */
        .alert {
            border-radius: 12px;
            border: none;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: #dc2626;
        }

        /* Área de arrastrar y soltar */
        .file-drop-area {
            position: relative;
            border: 3px dashed rgba(59, 130, 246, 0.3);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            background: rgba(219, 234, 254, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-drop-area:hover, .file-drop-area.dragover {
            border-color: var(--secondary-blue);
            background: rgba(219, 234, 254, 0.5);
            transform: scale(1.02);
        }

        .file-drop-icon {
            font-size: 3rem;
            color: var(--accent-blue);
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Texto de ayuda */
        .form-text {
            color: var(--primary-blue);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Validación */
        .invalid-feedback {
            color: #dc2626;
            font-weight: 500;
        }

        .valid-feedback {
            color: #059669;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .card-header {
                padding: 1.5rem;
            }
            
            .excel-icon {
                font-size: 1rem !important;
            }
        }
    </style>
</head>
<body>
    <!-- Animaciones de fondo -->
    <div class="background-animation">
        <i class="fas fa-file-excel excel-icon"></i>
        <i class="fas fa-table excel-icon"></i>
        <i class="fas fa-chart-bar excel-icon"></i>
        <i class="fas fa-calculator excel-icon"></i>
        <i class="fas fa-file-csv excel-icon"></i>
        <i class="fas fa-database excel-icon"></i>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card main-card shadow-lg">
                    <div class="card-header">
                        <h4 class="text-white">
                            <i class="fas fa-file-excel"></i>
                            Importar datos desde Excel
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('importar') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-4">
                                <label for="tipo_datos" class="form-label">
                                    <i class="fas fa-list-ul me-2"></i>Tipo de datos a importar
                                </label>
                                <select class="form-select" id="tipo_datos" name="tipo_datos" required>
                                    <option value="" selected disabled>Seleccione el tipo de datos</option>
                                    <option value="evaluaciones">📊 Evaluaciones de docentes</option>
                                    <option value="programas">🎓 Programas académicos</option>
                                    <option value="estudiantes">👥 Datos de estudiantes</option>
                                </select>
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    Por favor seleccione el tipo de datos a importar.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="archivo" class="form-label">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>Archivo Excel
                                </label>
                                <div class="file-drop-area" onclick="document.getElementById('archivo').click()">
                                    <div class="file-drop-icon">
                                        <i class="fas fa-file-excel"></i>
                                    </div>
                                    <p class="mb-2"><strong>Haz clic aquí o arrastra tu archivo</strong></p>
                                    <p class="text-muted mb-0">Formatos permitidos: .xlsx, .xls, .csv</p>
                                </div>
                                <input type="file" class="form-control d-none" id="archivo" name="archivo" accept=".xlsx,.xls,.csv" required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    El archivo debe contener las columnas requeridas según el tipo de datos seleccionado
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    Por favor seleccione un archivo Excel válido.
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload me-1"></i> Importar datos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación de formulario con Bootstrap
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Funcionalidad de arrastrar y soltar
        const fileDropArea = document.querySelector('.file-drop-area');
        const fileInput = document.getElementById('archivo');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, unhighlight, false);
        });

        fileDropArea.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            fileDropArea.classList.add('dragover');
        }

        function unhighlight(e) {
            fileDropArea.classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            if (files.length > 0) {
                updateFileDisplay(files[0].name);
            }
        }

        // Actualizar display cuando se selecciona archivo
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                updateFileDisplay(e.target.files[0].name);
            }
        });

        function updateFileDisplay(fileName) {
            const icon = fileDropArea.querySelector('.file-drop-icon i');
            const text = fileDropArea.querySelector('p strong');
            
            icon.className = 'fas fa-file-check';
            text.textContent = fileName;
            fileDropArea.style.borderColor = '#059669';
            fileDropArea.style.background = 'rgba(220, 252, 231, 0.3)';
        }
    </script>
</body>
</html>