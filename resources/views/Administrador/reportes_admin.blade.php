@extends('layouts.principal')
@section('titulo', 'Panel de Administrador')
@section('contenido')
 <!-- Encabezado y bienvenida -->
                    <div class="header-card animated-card">
                        <h1>Reportes y Estadísticas</h1>
                        <p class="text-muted">Visualización y análisis de datos del sistema de evaluación docente</p>
                    </div>

                    <!-- Filtros de reportes -->
                    <div class="filter-card mb-4 animated-card">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="periodoFilter" class="form-label">Periodo Académico</label>
                                <select class="form-select" id="periodoFilter">
                                    <option value="2025-1">2025-1</option>
                                    <option value="2024-2">2024-2</option>
                                    <option value="2024-1">2024-1</option>
                                    <option value="2023-2">2023-2</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="departamentoFilter" class="form-label">Departamento</label>
                                <select class="form-select" id="departamentoFilter">
                                    <option value="todos">Todos los departamentos</option>
                                    <option value="ingenieria">Ingeniería</option>
                                    <option value="ciencias">Ciencias</option>
                                    <option value="humanidades">Humanidades</option>
                                    <option value="artes">Artes</option>
                                    <option value="economia">Economía</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="tipoReporte" class="form-label">Tipo de Reporte</label>
                                <select class="form-select" id="tipoReporte">
                                    <option value="evaluaciones">Evaluaciones</option>
                                    <option value="desempeno">Desempeño</option>
                                    <option value="comparativo">Comparativo</option>
                                    <option value="tendencias">Tendencias</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <button class="btn btn-primary w-100" id="aplicarFiltros">
                                    <i class="fas fa-filter me-2"></i>Aplicar Filtros
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Indicadores KPI -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="kpi-card bg-primary bg-opacity-10">
                                <i class="fas fa-tasks kpi-icon text-primary"></i>
                                <div class="kpi-value">87%</div>
                                <div class="kpi-label">Evaluaciones Completadas</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="kpi-card bg-success bg-opacity-10">
                                <i class="fas fa-star kpi-icon text-success"></i>
                                <div class="kpi-value">4.2</div>
                                <div class="kpi-label">Promedio de Calificación</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="kpi-card bg-warning bg-opacity-10">
                                <i class="fas fa-exclamation-triangle kpi-icon text-warning"></i>
                                <div class="kpi-value">12</div>
                                <div class="kpi-label">Docentes con Bajo Desempeño</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="kpi-card bg-info bg-opacity-10">
                                <i class="fas fa-file-alt kpi-icon text-info"></i>
                                <div class="kpi-value">35</div>
                                <div class="kpi-label">Planes de Mejora Activos</div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestañas de reportes -->
                    <ul class="nav nav-tabs mb-0" id="reportesTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="graficos-tab" data-bs-toggle="tab"
                                data-bs-target="#graficos" type="button" role="tab" aria-controls="graficos"
                                aria-selected="true">
                                <i class="fas fa-chart-pie me-2"></i>Gráficos
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tablas-tab" data-bs-toggle="tab" data-bs-target="#tablas"
                                type="button" role="tab" aria-controls="tablas" aria-selected="false">
                                <i class="fas fa-table me-2"></i>Tablas de Datos
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="exportar-tab" data-bs-toggle="tab" data-bs-target="#exportar"
                                type="button" role="tab" aria-controls="exportar" aria-selected="false">
                                <i class="fas fa-file-export me-2"></i>Exportar Reportes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tendencias-tab" data-bs-toggle="tab"
                                data-bs-target="#tendencias" type="button" role="tab" aria-controls="tendencias"
                                aria-selected="false">
                                <i class="fas fa-chart-line me-2"></i>Tendencias
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="reportesTabsContent">
                        <!-- Pestaña de Gráficos -->
                        <div class="tab-pane fade show active" id="graficos" role="tabpanel"
                            aria-labelledby="graficos-tab">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Desempeño por Departamento</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="desempenoChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Distribución de Calificaciones</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="calificacionesChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Comparativa entre Periodos</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="comparativaChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Áreas de Mejora Identificadas</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container">
                                                <canvas id="areasChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pestaña de Tablas de Datos -->
                        <div class="tab-pane fade" id="tablas" role="tabpanel" aria-labelledby="tablas-tab">
                            <div class="card mb-4">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Resultados de Evaluación por Docente</h5>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-search me-1"></i>Buscar
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-file-excel me-1"></i>Exportar
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover datatable table-admin">
                                            <thead>
                                                <tr>
                                                    <th>Docente</th>
                                                    <th>Departamento</th>
                                                    <th>Calificación</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Carlos Rodríguez</td>
                                                    <td>Ingeniería</td>
                                                    <td>4.5</td>
                                                    <td><span class="badge bg-success">Excelente</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary btn-action"
                                                            data-bs-toggle="tooltip" title="Descargar reporte">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ana Martínez</td>
                                                    <td>Ciencias</td>
                                                    <td>4.2</td>
                                                    <td><span class="badge bg-success">Excelente</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary btn-action"
                                                            data-bs-toggle="tooltip" title="Descargar reporte">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Juan Pérez</td>
                                                    <td>Humanidades</td>
                                                    <td>3.8</td>
                                                    <td><span class="badge bg-primary">Bueno</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary btn-action"
                                                            data-bs-toggle="tooltip" title="Descargar reporte">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>María López</td>
                                                    <td>Artes</td>
                                                    <td>4.0</td>
                                                    <td><span class="badge bg-primary">Bueno</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary btn-action"
                                                            data-bs-toggle="tooltip" title="Descargar reporte">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pedro Gómez</td>
                                                    <td>Economía</td>
                                                    <td>2.5</td>
                                                    <td><span class="badge bg-danger">Bajo</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalle">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary btn-action"
                                                            data-bs-toggle="tooltip" title="Descargar reporte">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pestaña de Exportar Reportes -->
                        <div class="tab-pane fade" id="exportar" role="tabpanel" aria-labelledby="exportar-tab">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Reportes Generales</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group">
                                                <a href="#"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                                        Reporte General de Evaluación Docente
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">PDF</span>
                                                </a>
                                                <a href="#"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file-excel text-success me-2"></i>
                                                        Datos Completos de Evaluaciones
                                                    </div>
                                                    <span class="badge bg-success rounded-pill">Excel</span>
                                                </a>
                                                <a href="#"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file-csv text-primary me-2"></i>
                                                        Resultados por Departamento
                                                    </div>
                                                    <span class="badge bg-info rounded-pill">CSV</span>
                                                </a>
                                                <a href="#"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                                        Informe de Planes de Mejora
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">PDF</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Reportes Personalizados</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="reporteTipo" class="form-label">Tipo de Reporte</label>
                                                    <select class="form-select" id="reporteTipo">
                                                        <option value="evaluacion">Evaluación Docente</option>
                                                        <option value="desempeno">Desempeño por Departamento</option>
                                                        <option value="comparativo">Comparativo entre Periodos</option>
                                                        <option value="mejora">Planes de Mejora</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reporteFormato" class="form-label">Formato</label>
                                                    <select class="form-select" id="reporteFormato">
                                                        <option value="pdf">PDF</option>
                                                        <option value="excel">Excel</option>
                                                        <option value="csv">CSV</option>
                                                        <option value="word">Word</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reporteContenido" class="form-label">Contenido</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkGraficos" checked>
                                                        <label class="form-check-label" for="checkGraficos">
                                                            Incluir gráficos
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkTablas" checked>
                                                        <label class="form-check-label" for="checkTablas">
                                                            Incluir tablas de datos
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkAnalisis">
                                                        <label class="form-check-label" for="checkAnalisis">
                                                            Incluir análisis
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="checkRecomendaciones">
                                                        <label class="form-check-label" for="checkRecomendaciones">
                                                            Incluir recomendaciones
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fas fa-file-export me-2"></i>Generar Reporte
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pestaña de Tendencias -->
                        <div class="tab-pane fade" id="tendencias" role="tabpanel" aria-labelledby="tendencias-tab">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div
                                            class="card-header bg-white d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Evolución del Desempeño Docente</h5>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary active"
                                                    data-period="year">Anual</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-period="semester">Semestral</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-period="quarter">Trimestral</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-container" style="height: 400px;">
                                                <canvas id="tendenciasChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Análisis de Tendencias</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>Análisis automático:</strong> Basado en los datos históricos de
                                                evaluación docente.
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex align-items-center">
                                                    <i class="fas fa-arrow-up text-success me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1">Mejora en Metodología</h6>
                                                        <p class="mb-0 text-muted small">Incremento del 12% en
                                                            calificaciones de metodología docente en los últimos 3
                                                            periodos.</p>
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <i class="fas fa-arrow-down text-danger me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1">Disminución en Puntualidad</h6>
                                                        <p class="mb-0 text-muted small">Reducción del 8% en
                                                            calificaciones de puntualidad y asistencia.</p>
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <i class="fas fa-equals text-warning me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1">Estabilidad en Evaluación</h6>
                                                        <p class="mb-0 text-muted small">Los métodos de evaluación se
                                                            mantienen constantes en los últimos 4 periodos.</p>
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <i class="fas fa-arrow-up text-success me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1">Mejora en Materiales</h6>
                                                        <p class="mb-0 text-muted small">Incremento del 15% en
                                                            calificaciones sobre materiales y recursos educativos.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0">Predicciones y Recomendaciones</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-lightbulb me-2"></i>
                                                <strong>Recomendaciones basadas en IA:</strong> Sugerencias para mejorar
                                                el desempeño docente.
                                            </div>
                                            <div class="mb-4">
                                                <h6 class="border-bottom pb-2">Predicción para próximo periodo</h6>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="progress flex-grow-1 me-3" style="height: 8px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="text-success fw-bold">85%</span>
                                                </div>
                                                <p class="text-muted small">Se espera un incremento general del 5% en
                                                    las calificaciones para el próximo periodo académico.</p>
                                            </div>
                                            <div>
                                                <h6 class="border-bottom pb-2">Recomendaciones principales</h6>
                                                <ol class="ps-3">
                                                    <li class="mb-2">Implementar talleres de puntualidad y gestión del
                                                        tiempo para docentes.</li>
                                                    <li class="mb-2">Reforzar el uso de tecnologías educativas en el
                                                        aula.</li>
                                                    <li class="mb-2">Desarrollar programas de mentoría entre docentes
                                                        con alto y bajo desempeño.</li>
                                                    <li class="mb-2">Establecer incentivos para docentes con mejora
                                                        continua.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Script personalizado -->
    <script src="js/LogicaAdministrador/Admin-script.js"></script>

    <script>
        // Script específico para la página de reportes y estadísticas
        document.addEventListener('DOMContentLoaded', function () {
            // La inicialización de DataTables ahora se maneja en admin-script.js
            // para evitar reinicializaciones

            // Inicializar gráficos específicos de reportes
            initializeReportCharts();

            // Manejar eventos de botones de filtro
            const aplicarFiltrosBtn = document.getElementById('aplicarFiltros');
            if (aplicarFiltrosBtn) {
                aplicarFiltrosBtn.addEventListener('click', function () {
                    // En una implementación real, esto actualizaría los datos según los filtros
                    alert('Filtros aplicados. Los datos se actualizarán según los criterios seleccionados.');
                    // Aquí se actualizarían los gráficos y tablas con los nuevos datos filtrados
                });
            }

            // Manejar eventos de botones de periodo en tendencias
            const periodButtons = document.querySelectorAll('[data-period]');
            periodButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Remover clase active de todos los botones
                    periodButtons.forEach(btn => btn.classList.remove('active'));
                    // Añadir clase active al botón actual
                    this.classList.add('active');

                    // En una implementación real, esto actualizaría el gráfico de tendencias
                    const period = this.getAttribute('data-period');
                    alert(`Cambiando vista a periodo: ${period}`);
                    // Aquí se actualizaría el gráfico con los datos del periodo seleccionado
                });
            });

            // Manejar eventos de botones de exportación
            const exportButtons = document.querySelectorAll('.btn-outline-success');
            exportButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // En una implementación real, esto exportaría los datos
                    alert('Exportando datos...');
                });
            });
        });

        // Inicializar gráficos específicos para reportes
        function initializeReportCharts() {
            // Gráfico de desempeño por departamento
            if (document.getElementById('desempenoChart')) {
                const ctxDesempeno = document.getElementById('desempenoChart').getContext('2d');
                const desempenoChart = new Chart(ctxDesempeno, {
                    type: 'bar',
                    data: {
                        labels: ['Ingeniería', 'Ciencias', 'Humanidades', 'Artes', 'Economía'],
                        datasets: [{
                            label: 'Promedio de Desempeño',
                            data: [4.2, 3.9, 4.5, 4.1, 3.7],
                            backgroundColor: [
                                'rgba(13, 110, 253, 0.7)',
                                'rgba(25, 135, 84, 0.7)',
                                'rgba(111, 66, 193, 0.7)',
                                'rgba(220, 53, 69, 0.7)',
                                'rgba(255, 193, 7, 0.7)'
                            ],
                            borderColor: [
                                'rgba(13, 110, 253, 1)',
                                'rgba(25, 135, 84, 1)',
                                'rgba(111, 66, 193, 1)',
                                'rgba(220, 53, 69, 1)',
                                'rgba(255, 193, 7, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 3.0,
                                max: 5.0
                            }
                        }
                    }
                });
            }

            // Gráfico de distribución de calificaciones
            if (document.getElementById('calificacionesChart')) {
                const ctxCalificaciones = document.getElementById('calificacionesChart').getContext('2d');
                const calificacionesChart = new Chart(ctxCalificaciones, {
                    type: 'pie',
                    data: {
                        labels: ['Excelente (4.5-5.0)', 'Bueno (4.0-4.4)', 'Satisfactorio (3.5-3.9)', 'Regular (3.0-3.4)', 'Bajo (<3.0)'],
                        datasets: [{
                            data: [25, 35, 20, 15, 5],
                            backgroundColor: [
                                'rgba(25, 135, 84, 0.7)',
                                'rgba(13, 110, 253, 0.7)',
                                'rgba(255, 193, 7, 0.7)',
                                'rgba(255, 128, 0, 0.7)',
                                'rgba(220, 53, 69, 0.7)'
                            ],
                            borderColor: [
                                'rgba(25, 135, 84, 1)',
                                'rgba(13, 110, 253, 1)',
                                'rgba(255, 193, 7, 1)',
                                'rgba(255, 128, 0, 1)',
                                'rgba(220, 53, 69, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${percentage}% (${value} docentes)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Gráfico comparativo entre periodos
            if (document.getElementById('comparativaChart')) {
                const ctxComparativa = document.getElementById('comparativaChart').getContext('2d');
                const comparativaChart = new Chart(ctxComparativa, {
                    type: 'bar',
                    data: {
                        labels: ['Ingeniería', 'Ciencias', 'Humanidades', 'Artes', 'Economía'],
                        datasets: [
                            {
                                label: '2024-1',
                                data: [4.2, 3.9, 4.5, 4.1, 3.7],
                                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                                borderColor: 'rgba(13, 110, 253, 1)',
                                borderWidth: 1
                            },
                            {
                                label: '2023-2',
                                data: [4.0, 3.7, 4.3, 4.0, 3.5],
                                backgroundColor: 'rgba(25, 135, 84, 0.7)',
                                borderColor: 'rgba(25, 135, 84, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 3.0,
                                max: 5.0
                            }
                        }
                    }
                });
            }

            // Gráfico de áreas de mejora
            if (document.getElementById('areasChart')) {
                const ctxAreas = document.getElementById('areasChart').getContext('2d');
                const areasChart = new Chart(ctxAreas, {
                    type: 'radar',
                    data: {
                        labels: ['Metodología', 'Evaluación', 'Comunicación', 'Puntualidad', 'Materiales', 'Retroalimentación'],
                        datasets: [{
                            label: 'Promedio Actual',
                            data: [4.2, 3.8, 4.0, 3.5, 4.1, 3.7],
                            backgroundColor: 'rgba(13, 110, 253, 0.2)',
                            borderColor: 'rgba(13, 110, 253, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(13, 110, 253, 1)'
                        }, {
                            label: 'Objetivo',
                            data: [4.5, 4.5, 4.5, 4.5, 4.5, 4.5],
                            backgroundColor: 'rgba(25, 135, 84, 0.0)',
                            borderColor: 'rgba(25, 135, 84, 1)',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            pointBackgroundColor: 'rgba(25, 135, 84, 0)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            r: {
                                min: 3.0,
                                max: 5.0,
                                ticks: {
                                    stepSize: 0.5
                                }
                            }
                        }
                    }
                });
            }

            // Gráfico de tendencias
            if (document.getElementById('tendenciasChart')) {
                const ctxTendencias = document.getElementById('tendenciasChart').getContext('2d');
                const tendenciasChart = new Chart(ctxTendencias, {
                    type: 'line',
                    data: {
                        labels: ['2022-2', '2023-1', '2023-2', '2024-1', '2024-2', '2025-1'],
                        datasets: [
                            {
                                label: 'Ingeniería',
                                data: [3.8, 3.9, 4.0, 4.2, 4.3, 4.4],
                                borderColor: 'rgba(13, 110, 253, 1)',
                                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: 'Ciencias',
                                data: [3.7, 3.7, 3.8, 3.9, 4.0, 4.1],
                                borderColor: 'rgba(25, 135, 84, 1)',
                                backgroundColor: 'rgba(25, 135, 84, 0.1)',
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: 'Humanidades',
                                data: [4.1, 4.2, 4.3, 4.5, 4.6, 4.7],
                                borderColor: 'rgba(111, 66, 193, 1)',
                                backgroundColor: 'rgba(111, 66, 193, 0.1)',
                                tension: 0.3,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 3.5,
                                max: 5.0
                            }
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            },
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            }
        }
    </script>
@endsection