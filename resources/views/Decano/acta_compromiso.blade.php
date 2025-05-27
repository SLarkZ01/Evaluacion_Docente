@extends('layouts.principal')
@section('titulo', 'Acta de Compromiso')
@section('contenido')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h1 class="h3 mb-0">📋 Actas de Compromiso Registradas</h1>
                        <p class="mb-0">Gestión completa de actas de compromiso docente</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="row mb-4" id="stats-container">
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h3>{{ $totalActas }}</h3>
                        <p class="mb-0">Total de Actas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h3>{{ number_format($promedioGeneral, 2) }}</h3>
                        <p class="mb-0">Promedio General</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h3>{{ $actasMes }}</h3>
                        <p class="mb-0">Actas este Mes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white">
                    <div class="card-body text-center">
                        <h3>{{ $actasFirmadas }}</h3>
                        <p class="mb-0">Actas Firmadas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('decano.acta_compromiso') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text">🔍</span>
                        <input type="text" class="form-control" name="search"
                            placeholder="Buscar por nombre, apellido, identificación..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('decano.acta_compromiso') }}" class="btn btn-outline-primary me-2">
                    🔄 Actualizar
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createActaModal">
                    ➕ Nueva Acta
                </button>
            </div>
        </div>

        <!-- Mensajes -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabla de Actas -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Docente</th>
                                <th>Identificación</th>
                                <th>Curso</th>
                                <th>Promedio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($actas as $acta)
                                <tr>
                                    <td>{{ $acta->numero_acta }}</td>
                                    <td>{{ \Carbon\Carbon::parse($acta->fecha_generacion)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ $acta->nombre_docente }} {{ $acta->apellido_docente }}
                                    </td>
                                    <td>{{ $acta->identificacion_docente }}</td>
                                    <td>{{ $acta->curso }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $acta->promedio_total < 3 ? 'bg-danger' : ($acta->promedio_total < 4 ? 'bg-warning' : 'bg-success') }}">
                                            {{ number_format($acta->promedio_total, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $acta->firma ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $acta->firma ? 'Firmada' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-primary btn-ver-acta" data-bs-toggle="modal"
                                                data-bs-target="#viewActaModal" data-numero="{{ $acta->numero_acta }}"
                                                data-fecha="{{ \Carbon\Carbon::parse($acta->fecha_generacion)->format('d/m/Y') }}"
                                                data-docente="{{ $acta->nombre_docente }} {{ $acta->apellido_docente }}"
                                                data-identificacion="{{ $acta->identificacion_docente }}"
                                                data-curso="{{ $acta->curso }}"
                                                data-promedio="{{ number_format($acta->promedio_total, 2) }}"
                                                data-retroalimentacion="{{ $acta->retroalimentacion }}"
                                                data-firma-url="{{ $acta->firma_url ?? '' }}">
                                                VER
                                            </button>


                                            <button class="btn btn-primary btn-editar-acta" data-bs-toggle="modal"
                                                data-bs-target="#editActaModal" data-id="{{ $acta->id }}"
                                                data-numero="{{ $acta->numero_acta }}"
                                                data-fecha="{{ $acta->fecha_generacion }}"
                                                data-nombre="{{ $acta->nombre_docente }}"
                                                data-apellido="{{ $acta->apellido_docente }}"
                                                data-identificacion="{{ $acta->identificacion_docente }}"
                                                data-curso="{{ $acta->curso }}"
                                                data-promedio="{{ $acta->promedio_total }}"
                                                data-retroalimentacion="{{ $acta->retroalimentacion }}"
                                                data-firma-url="{{ $acta->firma_url ?? '' }}">
                                                <i class="fas fa-edit"></i>
                                            </button>



                                            <form action="{{ route('decano.acta_compromiso.destroy', $acta->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Está seguro de eliminar esta acta?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                                        <h3>No hay actas de compromiso registradas</h3>
                                        <p class="text-muted">Comienza creando tu primera acta de compromiso</p>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#createActaModal">
                                            ➕ Crear Primera Acta
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                @if ($actas->hasPages())
                    <div class="mt-3">
                        {{ $actas->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Crear Acta -->

    <div class="modal fade" id="createActaModal" tabindex="-1" aria-labelledby="createActaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createActaModalLabel">Nueva Acta de Compromiso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="actaForm" action="{{ route('decano.acta_compromiso.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Docente:</label>
                                <select class="form-select" id="docenteSelect" name="id_docente" required>
                                    <option value="">Seleccione un docente</option>
                                    @foreach ($docentesbusqueda as $docente)
                                        <option value="{{ $docente->id_docente }}"
                                            data-nombre="{{ $docente->nombre_docente }}"
                                            data-apellido="{{ $docente->apellido_docente }}"
                                            data-identificacion="{{ $docente->identificacion_docente }}"
                                            data-curso="{{ $docente->curso }}"
                                            data-promedio="{{ $docente->promedio_total }}">
                                            {{ $docente->nombre_docente }} {{ $docente->apellido_docente }} -
                                            {{ $docente->curso }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Generación:</label>
                                <input type="date" class="form-control" name="fecha_generacion"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre:</label>
                                <textarea type="text" class ="form-control" name="nombre_docente" id="nombreDocente" readonly></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellido:</label>
                                <textarea type="text" class ="form-control" name="apellido_docente" id="apellidoDocente" readonly></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Identificación:</label>
                                <textarea type="text" class ="form-control" name="identificacion_docente" id="identificacionDocente" readonly></textarea>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Curso:</label>
                                <textarea type="text" class ="form-control" name="curso" id="curso" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Promedio Total:</label>
                                <textarea type="text" class ="form-control" name="promedio_total" id="promedio_docente" readonly></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Firma Digital:</label>
                                <input type="file" class="form-control" name="firma" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Retroalimentación:</label>
                            <textarea class="form-control" name="retroalimentacion" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Acta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ver Acta -->
    <div class="modal fade" id="viewActaModal" tabindex="-1" aria-labelledby="viewActaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewActaModalLabel">Detalles del Acta de Compromiso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Número de Acta:</label>
                            <p id="view-numero-acta" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Fecha de Generación:</label>
                            <p id="view-fecha-generacion" class="form-control-plaintext"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Docente:</label>
                            <p id="view-docente" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Identificación:</label>
                            <p id="view-identificacion" class="form-control-plaintext"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Curso/Asignatura:</label>
                            <p id="view-curso" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Promedio:</label>
                            <p id="view-promedio" class="form-control-plaintext"></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Retroalimentación:</label>
                        <div id="view-retroalimentacion" class="border p-3 rounded bg-light"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Firma Digital:</label>
                        <div id="view-firma-container" class="text-center">
                            <img id="view-firma-imagen" src="" class="img-fluid mb-2"
                                style="max-height: 150px; display: none;">
                            <div id="view-firma-placeholder" class="text-muted py-4 border rounded">
                                <i class="fas fa-signature fa-4x"></i>
                                <p class="mt-2">No se ha registrado firma digital</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-imprimir-acta">
                        <i class="fas fa-print me-1"></i> Imprimir Acta
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar Acta -->
    <div class="modal fade" id="editActaModal" tabindex="-1" aria-labelledby="editActaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editActaModalLabel">Editar Acta de Compromiso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="editActaForm" method="PUT" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-acta-id" name="id">

                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Número de Acta:</label>
                                <input type="text" class="form-control" id="edit-numero-acta" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Generación:</label>
                                <input type="date" class="form-control" id="edit-fecha-generacion"
                                    name="fecha_generacion" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Docente:</label>
                                <input type="text" class="form-control" id="edit-nombre-docente"
                                    name="nombre_docente" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellido Docente:</label>
                                <input type="text" class="form-control" id="edit-apellido-docente"
                                    name="apellido_docente" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Identificación:</label>
                                <input type="text" class="form-control" id="edit-identificacion"
                                    name="identificacion_docente" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Curso/Asignatura:</label>
                                <input type="text" class="form-control" id="edit-curso" name="curso" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Promedio:</label>
                                <input type="number" step="0.01" min="0" max="5" class="form-control"
                                    id="edit-promedio" name="promedio_total" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Estado:</label>
                                <div class="form-control" id="edit-estado-promedio" readonly>
                                    <span id="edit-estado-texto">No seleccionado</span>
                                    <span class="badge ms-2" id="edit-estado-badge">--</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Retroalimentación:</label>
                            <textarea class="form-control" id="edit-retroalimentacion" name="retroalimentacion" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Firma Digital:</label>
                            <div class="border p-3 text-center">
                                <img id="edit-firma-preview" src="" class="img-fluid mb-2"
                                    style="max-height: 150px; display: none;">
                                <div id="edit-firma-placeholder" class="text-muted py-4">
                                    <i class="fas fa-signature fa-3x"></i>
                                    <p class="mt-2">Firma actual no disponible</p>
                                </div>
                                <input type="file" class="form-control mt-2" id="edit-firma-input" name="firma"
                                    accept="image/*">
                                <small class="text-muted">Dejar en blanco para mantener la firma actual</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-guardar-cambios">Guardar Cambios</button>
                        {{-- <button type="submit" class="btn btn-primary"  id="btn-guardar-cambios">Guardar Cambios</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botonesVer = document.querySelectorAll('.btn-ver-acta');

            botonesVer.forEach(boton => {
                boton.addEventListener('click', function() {
                    // Setear campos de texto
                    document.getElementById('view-numero-acta').textContent = this.dataset.numero;
                    document.getElementById('view-fecha-generacion').textContent = this.dataset
                        .fecha;
                    document.getElementById('view-docente').textContent = this.dataset.docente;
                    document.getElementById('view-identificacion').textContent = this.dataset
                        .identificacion;
                    document.getElementById('view-curso').textContent = this.dataset.curso;
                    document.getElementById('view-promedio').textContent = this.dataset.promedio;
                    document.getElementById('view-retroalimentacion').textContent = this.dataset
                        .retroalimentacion;

                    // Firma digital
                    const firmaUrl = this.dataset.firmaUrl;
                    const firmaImagen = document.getElementById('view-firma-imagen');
                    const firmaPlaceholder = document.getElementById('view-firma-placeholder');

                    if (firmaUrl) {
                        firmaImagen.src = firmaUrl;
                        firmaImagen.style.display = 'block';
                        firmaPlaceholder.style.display = 'none';
                    } else {
                        firmaImagen.src = '';
                        firmaImagen.style.display = 'none';
                        firmaPlaceholder.style.display = 'block';
                    }
                });
            });
        });
    </script>



    <script>
        document.getElementById('docenteSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            document.getElementById('nombreDocente').value = selectedOption.getAttribute('data-nombre') || '';
            document.getElementById('apellidoDocente').value = selectedOption.getAttribute('data-apellido') || '';
            document.getElementById('identificacionDocente').value = selectedOption.getAttribute(
                'data-identificacion') || '';
            document.getElementById('curso').value = selectedOption.getAttribute('data-curso') || '';
            document.getElementById('promedio_docente').value = selectedOption.getAttribute('data-promedio') || '';
        });
    </script>
    <script>
        // Manejar carga de firma (código original mejorado)
        $('#seleccionar-firma').click(function() {
            $('#firma-input').trigger('click');
        });

        $('#firma-input').change(function(e) {
            const file = e.target.files[0];
            if (!file) return;

            if (!file.type.match('image.*')) {
                alert('Por favor seleccione un archivo de imagen');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#firma-imagen').attr('src', e.target.result);
                $('#firma-preview').removeClass('d-none');
                $('#firma-placeholder').addClass('d-none');
                $('#eliminar-firma').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        });

        $('#eliminar-firma').click(function() {
            $('#firma-input').val('');
            $('#firma-imagen').attr('src', '');
            $('#firma-preview').addClass('d-none');
            $('#firma-placeholder').removeClass('d-none');
            $(this).addClass('d-none');
        });

        // Manejar envío del formulario
        $('#actaForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#createActaModal').modal('hide');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Error al procesar la solicitud';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    toastr.error(errorMsg);
                    console.error(xhr.responseText);
                }
            });
        });


        // Función para abrir modal de visualización
        function openViewModal(actaId) {
            $.ajax({
                url: `/actas-compromiso/${actaId}`,
                type: 'GET',
                success: function(response) {
                    // Llenar datos en el modal
                    $('#view-numero-acta').text(response.numero_acta);
                    $('#view-fecha-generacion').text(formatDate(response.fecha_generacion));
                    $('#view-docente').text(`${response.nombre_docente} ${response.apellido_docente}`);
                    $('#view-identificacion').text(response.identificacion_docente);
                    $('#view-curso').text(response.curso);
                    $('#view-promedio').html(
                        `<span class="badge ${getScoreBadgeClass(response.promedio_total)}">${response.promedio_total}</span>`
                    );
                    $('#view-retroalimentacion').text(response.retroalimentacion);

                    // Manejar imagen de firma
                    if (response.firma) {
                        $('#view-firma-imagen').attr('src', `/storage/${response.firma}`).show();
                        $('#view-firma-placeholder').hide();
                    } else {
                        $('#view-firma-imagen').hide();
                        $('#view-firma-placeholder').show();
                    }

                    // Mostrar modal
                    $('#viewActaModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error('Error al cargar los datos del acta');
                    console.error(xhr.responseText);
                }
            });
        }

        // Función para abrir modal de edición
        function openEditModal(actaId) {
            $.ajax({
                url: `/actas-compromiso/${actaId}/edit`,
                type: 'GET',
                success: function(response) {
                    // Configurar formulario
                    $('#editActaForm').attr('action', `/actas-compromiso/${response.id}`);
                    $('#edit-acta-id').val(response.id);
                    $('#edit-numero-acta').val(response.numero_acta);
                    $('#edit-fecha-generacion').val(response.fecha_generacion);
                    $('#edit-nombre-docente').val(response.nombre_docente);
                    $('#edit-apellido-docente').val(response.apellido_docente);
                    $('#edit-identificacion').val(response.identificacion_docente);
                    $('#edit-curso').val(response.curso);
                    $('#edit-promedio').val(response.promedio_total);
                    $('#edit-retroalimentacion').val(response.retroalimentacion);

                    // Configurar estado del promedio
                    updateScoreStatus(response.promedio_total);

                    // Configurar firma
                    if (response.firma) {
                        $('#edit-firma-preview').attr('src', `/storage/${response.firma}`).show();
                        $('#edit-firma-placeholder').hide();
                    } else {
                        $('#edit-firma-preview').hide();
                        $('#edit-firma-placeholder').show();
                    }

                    // Mostrar modal
                    $('#editActaModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error('Error al cargar los datos para edición');
                    console.error(xhr.responseText);
                }
            });
        }

        // Función para actualizar el estado del promedio
        function updateScoreStatus(promedio) {
            const badge = $('#edit-estado-badge');
            const text = $('#edit-estado-texto');

            badge.text(promedio);
            badge.removeClass('bg-danger bg-warning bg-success');

            if (promedio < 3) {
                text.text('Bajo Desempeño');
                badge.addClass('bg-danger');
            } else if (promedio < 4) {
                text.text('Desempeño Regular');
                badge.addClass('bg-warning text-dark');
            } else {
                text.text('Buen Desempeño');
                badge.addClass('bg-success');
            }
        }

        // Función para formatear fecha
        function formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }

        // Función para obtener clase CSS del badge según el promedio
        function getScoreBadgeClass(promedio) {
            if (promedio < 3) return 'bg-danger';
            if (promedio < 4) return 'bg-warning text-dark';
            return 'bg-success';
        }

        // Eventos para los botones de acción en la tabla
        $(document).on('click', '.btn-view-acta', function() {
            const actaId = $(this).data('id');
            openViewModal(actaId);
        });

        $(document).on('click', '.btn-edit-acta', function() {
            const actaId = $(this).data('id');
            openEditModal(actaId);
        });

        // Manejar cambio de promedio en edición
        $('#edit-promedio').on('input', function() {
            updateScoreStatus($(this).val());
        });

        // Manejar vista previa de firma en edición
        $('#edit-firma-input').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit-firma-preview').attr('src', e.target.result).show();
                    $('#edit-firma-placeholder').hide();
                };
                reader.readAsDataURL(file);
            }
        });

        // Manejar envío del formulario de edición
        $('#editActaForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#editActaModal').modal('hide');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Error al actualizar el acta';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    toastr.error(errorMsg);
                    console.error(xhr.responseText);
                }
            });
        });

        // Botón para imprimir acta
        $('#btn-imprimir-acta').click(function() {
            window.print();
        });
    </script>
    //SCRIP PARA AUTOCOMPLETAR EL MODAL EDITAR ACTA
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Botón de editar acta
            const botonesEditar = document.querySelectorAll('.btn-editar-acta');

            botonesEditar.forEach(boton => {
                boton.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const form = document.getElementById('editActaForm');
                    form.action =
                        `{{ route('decano.acta_compromiso.update', '') }}/${id}`; // Reemplaza con tu ruta real (ver más abajo)

                    document.getElementById('edit-acta-id').value = id;
                    document.getElementById('edit-numero-acta').value = this.dataset.numero;
                    document.getElementById('edit-fecha-generacion').value = this.dataset.fecha;
                    document.getElementById('edit-nombre-docente').value = this.dataset.nombre;
                    document.getElementById('edit-apellido-docente').value = this.dataset.apellido;
                    document.getElementById('edit-identificacion').value = this.dataset
                        .identificacion;
                    document.getElementById('edit-curso').value = this.dataset.curso;
                    document.getElementById('edit-promedio').value = this.dataset.promedio;
                    document.getElementById('edit-retroalimentacion').value = this.dataset
                        .retroalimentacion;

                    // Firma
                    const firmaUrl = this.dataset.firmaUrl;
                    const firmaImg = document.getElementById('edit-firma-preview');
                    const firmaPlaceholder = document.getElementById('edit-firma-placeholder');

                    if (firmaUrl) {
                        firmaImg.src = firmaUrl;
                        firmaImg.style.display = 'block';
                        firmaPlaceholder.style.display = 'none';
                    } else {
                        firmaImg.style.display = 'none';
                        firmaPlaceholder.style.display = 'block';
                    }

                    // Estado visual
                    const promedio = parseFloat(this.dataset.promedio);
                    let texto = '';
                    let clase = '';

                    if (promedio < 3) {
                        texto = 'Bajo';
                        clase = 'bg-danger';
                    } else if (promedio < 4) {
                        texto = 'Aceptable';
                        clase = 'bg-warning';
                    } else {
                        texto = 'Alto';
                        clase = 'bg-success';
                    }

                    document.getElementById('edit-estado-texto').textContent = texto;
                    const badge = document.getElementById('edit-estado-badge');
                    badge.textContent = texto;
                    badge.className = 'badge ' + clase;
                });
            });
        });
    </script>
    //SCRIP PARA GUARDAR ACTULIZAR LA BASE DE DATOS
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botonGuardar = document.getElementById('btn-guardar-cambios');
            const form = document.getElementById('editActaForm');

            botonGuardar.addEventListener('click', function() {
                const formData = new FormData(form);
                const id = formData.get('id');

                // Agrega el método PUT al formData para que Laravel lo entienda
                formData.append('_method', 'PUT');

                fetch(`/actas-compromiso/${id}`, {
                        method: 'POST', // Laravel lo interpretará como PUT por _method
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Error al guardar los cambios');
                        return response.json();
                    })
                    .then(data => {
                        alert('Acta actualizada correctamente');
                        location.reload(); // recarga la página o puedes cerrar el modal
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Hubo un error al actualizar el acta');
                    });
            });
        });
    </script>

@endsection
