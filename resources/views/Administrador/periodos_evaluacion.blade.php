@extends('layouts.principal')
@section('titulo', 'Panel de Administrador')
@section('contenido')
    <div class="container-fluid p-0">
        <div class="row g-0">

                    <!-- Encabezado -->
                    <div class="header-card animated-card">
                        <h1>Configuración de Periodos de Evaluación</h1>
                        <p class="text-muted">Administra los periodos de evaluación docente del sistema</p>
                    </div>

                    <!-- Sección de Periodo Actual -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Periodo Activo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <i class="fas fa-check-circle me-2 fa-lg"></i>
                                        <div>
                                            <strong>Periodo 2025-1 activo</strong>
                                            <p class="mb-0">El periodo de evaluación docente está activo hasta
                                                2025-06-30. Quedan 15 días para completar todas las evaluaciones
                                                pendientes.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Fecha de Inicio</h6>
                                                    <p class="card-text fw-bold">2025-01-15</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Fecha de Fin</h6>
                                                    <p class="card-text fw-bold">2025-06-30</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Evaluaciones Completadas</h6>
                                                    <p class="card-text fw-bold">32/45</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Progreso</h6>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 71%;"
                                                            aria-valuenow="71" aria-valuemin="0" aria-valuemax="100">71%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-outline-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Editar
                                        </button>
                                        <button class="btn btn-outline-danger">
                                            <i class="fas fa-times-circle me-1"></i> Finalizar Periodo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Gestión de Periodos -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Gestión de Periodos</h5>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#nuevoPeriodoModal">
                                        <i class="fas fa-plus me-2"></i>Nuevo Periodo
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover datatable table-admin">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Estado</th>
                                                    <th>Progreso</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Periodo 2025-1</td>
                                                    <td>2025-01-15</td>
                                                    <td>2025-06-30</td>
                                                    <td><span class="badge bg-success">Activo</span></td>
                                                    <td>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 71%;" aria-valuenow="71" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-action"
                                                            data-bs-toggle="tooltip" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info btn-action"
                                                            data-bs-toggle="tooltip" title="Ver detalles">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Próximos Periodos -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Próximos Periodos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="card period-card period-upcoming">
                                                <div class="card-body">
                                                    <h5 class="card-title">Periodo 2025-2</h5>
                                                    <p class="card-text">Programado para iniciar el 15 de julio de 2025
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge bg-primary">Programado</span>
                                                        <button class="btn btn-sm btn-outline-primary">Editar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card period-card period-upcoming">
                                                <div class="card-body">
                                                    <h5 class="card-title">Periodo 2026-1</h5>
                                                    <p class="card-text">Programado para iniciar el 15 de enero de 2026
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge bg-primary">Programado</span>
                                                        <button class="btn btn-sm btn-outline-primary">Editar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card period-card">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-plus-circle fa-3x text-muted mb-3"></i>
                                                    <h5 class="card-title">Crear Nuevo Periodo</h5>
                                                    <button class="btn btn-primary mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoPeriodoModal">
                                                        <i class="fas fa-plus me-2"></i>Nuevo Periodo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Configuración de Parámetros -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Configuración de Parámetros de Evaluación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="config-section">
                                                <div class="config-icon">
                                                    <i class="fas fa-sliders-h"></i>
                                                </div>
                                                <h4>Criterios de Evaluación</h4>
                                                <p class="text-muted">Configura los criterios y ponderaciones para la
                                                    evaluación docente</p>
                                                <button class="btn btn-outline-primary">
                                                    <i class="fas fa-cog me-2"></i>Configurar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="config-section">
                                                <div class="config-icon">
                                                    <i class="fas fa-bell"></i>
                                                </div>
                                                <h4>Notificaciones</h4>
                                                <p class="text-muted">Configura las notificaciones automáticas para los
                                                    periodos de evaluación</p>
                                                <button class="btn btn-outline-primary">
                                                    <i class="fas fa-cog me-2"></i>Configurar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Modal para Nuevo Periodo -->
    <div class="modal fade" id="nuevoPeriodoModal" tabindex="-1" aria-labelledby="nuevoPeriodoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoPeriodoModalLabel">Crear Nuevo Periodo de Evaluación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="nuevoPeriodoForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombrePeriodo" class="form-label">Nombre del Periodo</label>
                                <input type="text" class="form-control" id="nombrePeriodo"
                                    placeholder="Ej: Periodo 2025-2" required>
                            </div>
                            <div class="col-md-6">
                                <label for="estadoPeriodo" class="form-label">Estado</label>
                                <select class="form-select" id="estadoPeriodo" required>
                                    <option value="programado">Programado</option>
                                    <option value="activo">Activo</option>
                                    <option value="finalizado">Finalizado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fechaFin" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionPeriodo" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionPeriodo" rows="3"
                                placeholder="Descripción del periodo de evaluación"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Configuración de Notificaciones</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notifInicio" checked>
                                <label class="form-check-label" for="notifInicio">Notificar al inicio del
                                    periodo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notifRecordatorio" checked>
                                <label class="form-check-label" for="notifRecordatorio">Enviar recordatorios
                                    periódicos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notifFin" checked>
                                <label class="form-check-label" for="notifFin">Notificar al finalizar el periodo</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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
        // Script específico para la página de periodos de evaluación
        document.addEventListener('DOMContentLoaded', function () {
            // La inicialización de DataTables ahora se maneja en admin-script.js
            // para evitar reinicializaciones

            // Manejar eventos de botones de acción
            const editButtons = document.querySelectorAll('.btn-outline-primary');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // En una implementación real, esto abriría el modal con los datos del elemento
                    alert('Función de edición en desarrollo');
                });
            });

            // Manejar envío de formularios
            const saveButton = document.querySelector('#nuevoPeriodoModal .btn-primary');
            if (saveButton) {
                saveButton.addEventListener('click', function () {
                    // En una implementación real, esto guardaría los datos del formulario
                    alert('Periodo guardado correctamente');
                    // Cerrar el modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('nuevoPeriodoModal'));
                    modal.hide();
                });
            }

            // Manejar botón de finalizar periodo
            const finalizarButton = document.querySelector('.btn-outline-danger');
            if (finalizarButton) {
                finalizarButton.addEventListener('click', function () {
                    if (confirm('¿Está seguro que desea finalizar el periodo actual? Esta acción no se puede deshacer.')) {
                        // En una implementación real, esto finalizaría el periodo
                        alert('Periodo finalizado correctamente');
                    }
                });
            }
        });
    </script>

@endsection