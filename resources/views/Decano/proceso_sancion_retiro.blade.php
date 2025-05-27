@extends('layouts.principal')
@section('titulo', 'Acta de Compromiso')
@section('contenido')

   <!-- Incluye SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Incluye SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar / Menú lateral -->

            <!-- Contenido principal -->

            <div class="header-sancion mb-4">
                <h1 class="mb-0">Proceso de Sanción o Retiro Docente</h1>
            </div>
            <form id="formSancion" action="{{ route('decano.guardar_sancion') }}" method="POST" {{-- <form id="formSancion"
                action="{{ route('decano.guardar_sancion') }}" method="POST" --}} enctype="multipart/form-data"
                class="mb-5">
                @csrf
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Formulario de Sanción o Retiro</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="avatar-preview mb-3">
                                    <i class="fas fa-user fa-5x text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Seleccione un docente:</label>
                                        <select class="form-select select2-docentes" id="docenteSelect" name="id_docente">
                                            <option value="">Seleccione un docente</option>
                                            @if (isset($docentesbusqueda) && count($docentesbusqueda) > 0)
                                                @foreach ($docentesbusqueda as $docente)
                                                    <option value="{{ $docente->id_docente }}"
                                                        data-nombre="{{ $docente->nombre_docente }}"
                                                        data-apellido="{{ $docente->apellido_docente }}"
                                                        data-identificacion="{{ $docente->identificacion_docente }}"
                                                        data-asignatura="{{ $docente->curso }}"
                                                        data-calificacion="{{ $docente->promedio_total }}">
                                                        {{ $docente->nombre_docente }} {{ $docente->apellido_docente }} -
                                                        {{ $docente->curso }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">No hay docentes disponibles.</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Número de Resolución:</label>
                                        <input type="text" class="form-control" id="numeroResolucion"
                                            name="numero_resolucion" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Fecha de Emisión:</label>
                                        <input type="date" class="form-control" id="fechaEmision" name="fecha_emision"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="nombreDocente" name="nombre_docente"
                                            readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Apellido:</label>
                                        <input type="text" class="form-control" id="apellidoDocente" name="apellido_docente"
                                            readonly required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Identificación:</label>
                                        <input type="text" class="form-control" id="identificacionDocente"
                                            name="identificacion_docente" readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Asignatura:</label>
                                        <input type="text" class="form-control" id="asignaturaDocente" name="asignatura"
                                            readonly required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Calificación Final:</label>
                                        <input type="text" class="form-control" id="calificacionDocente"
                                            name="calificacion_final" readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tipo de Sanción:</label>
                                        <select class="form-select" id="tipoSancionSelect" name="tipo_sancion" required>
                                            <option value="">Seleccione tipo de sanción</option>
                                            <option value="leve">Sanción Leve</option>
                                            <option value="grave">Sanción Grave</option>
                                            <option value="retiro">Retiro Definitivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Antecedentes y Justificación:</h5>
                                <div class="mb-3">
                                    <textarea class="form-control" id="antecedentes"
                                        name="antecedentes">Describa aquí los antecedentes y el historial de evaluaciones del docente que justifican esta sanción...</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Fundamentos Normativos:</h5>
                                <div class="mb-3">
                                    <textarea class="form-control" id="fundamentos"
                                        name="fundamentos">Especifique aquí los reglamentos, estatutos y normativas institucionales que fundamentan esta decisión...</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5>Resolución y Medidas Adoptadas:</h5>
                                <div class="mb-3">
                                    <textarea class="form-control" id="resolucion"
                                        name="resolucion">Detalle aquí la resolución específica y las medidas disciplinarias adoptadas...</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-3">
                                <h5 class="text-center mb-3">Firma de Decano/ Coordinador</h5>
                                <div class="firma-box">
                                    <div id="firma-preview" class="mb-3 d-none">
                                        <img id="firma-imagen" src="#" alt="Vista previa de la firma" class="img-fluid"
                                            style="max-height: 100px;">
                                    </div>
                                    <div id="firma-placeholder" class="text-center text-muted mb-3">
                                        <i class="fas fa-signature fa-3x"></i>
                                        <p class="mt-2">Seleccione una imagen de firma</p>
                                    </div>
                                    <input type="file" id="firma-input" name="firma" class="form-control"
                                        accept=".png,.jpg,.jpeg" style="display: none;">
                                    <button type="button" id="seleccionar-firma" class="btn btn-outline-primary mb-2">
                                        <i class="fas fa-upload me-2"></i>Cargar Firma
                                    </button>
                                    <button type="button" id="eliminar-firma" class="btn btn-outline-danger d-none">
                                        <i class="fas fa-trash me-2"></i>Eliminar Firma
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                             <button type="submit" class="btn btn-danger me-2">
                                    <i class="fas fa-save me-2"></i>Guardar Resolución
                                </button>
                                <button type="button" class="btn btn-primary me-2" id="btnDescargarPDF">
                                    <i class="fas fa-file-pdf me-2"></i>Descargar PDF
                                </button>

                                <!-- Botón Enviar Resolución (usando ID consistente) -->
                                <button type="button" class="btn btn-dark" id="btnEnviarResolucion">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar Resolución
                                </button>
                                {{-- <button type="button" class="btn btn-dark" id="enviarResolucion">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar Resolución al Docente
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                document.getElementById('docenteSelect').addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];

                    document.getElementById('nombreDocente').value = selectedOption.getAttribute('data-nombre') || '';
                    document.getElementById('apellidoDocente').value = selectedOption.getAttribute('data-apellido') || '';
                    document.getElementById('identificacionDocente').value = selectedOption.getAttribute('data-identificacion') || '';
                    document.getElementById('asignaturaDocente').value = selectedOption.getAttribute('data-asignatura') || '';

                });
            </script>

            <!-- JavaScript para el formulario de sanción -->
            <script>
                $(document).ready(function () {
                    // Inicializar Select2 para el selector de docentes
                    $('.select2-docentes').select2({
                        placeholder: "Seleccione un docente",
                        allowClear: true,
                        width: '100%'
                    });

                    // Inicializar Summernote para los editores de texto enriquecido
                    $('#antecedentes, #fundamentos, #resolucion').summernote({
                        placeholder: 'Escriba aquí...',
                        tabsize: 2,
                        height: 150,
                        dialogsInBody: true,
                        dialogsFade: true,
                        container: 'body',
                        focus: false,
                        popover: {
                            image: [
                                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                                ['remove', ['removeMedia']]
                            ],
                            link: [
                                ['link', ['linkDialogShow', 'unlink']]
                            ],
                            air: []
                        },
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['picture', 'link', 'video']],
                            ['view', ['codeview', 'help']]
                        ]
                    });

                    // Manejar la selección de docente
                    $('#docenteSelect').on('change', function () {
                        const selectedOption = $(this).find('option:selected');

                        // Obtener los datos del docente seleccionado
                        const nombre = selectedOption.data('nombre') || '';
                        const apellido = selectedOption.data('apellido') || '';
                        const identificacion = selectedOption.data('identificacion') || '';
                        const asignatura = selectedOption.data('asignatura') || '';
                        const calificacion = selectedOption.data('calificacion') || '';

                        // Asignar los valores a los campos correspondientes
                        $('#nombreDocente').val(nombre);
                        $('#apellidoDocente').val(apellido);
                        $('#identificacionDocente').val(identificacion);
                        $('#asignaturaDocente').val(asignatura);
                        $('#calificacionDocente').val(calificacion);

                        // Cambiar el color del campo de calificación según el valor
                        const calificacionInput = $('#calificacionDocente');
                        calificacionInput.removeClass('calificacion-baja calificacion-media calificacion-alta');

                        const calificacionValue = parseFloat(calificacion);
                        if (calificacionValue < 3) {
                            calificacionInput.addClass('calificacion-baja');
                        } else if (calificacionValue < script 4) {
                        calificacionInput.addClass('calificacion-media');
                    } else {
                        calificacionInput.addClass('calificacion-alta');
                    }
                });

                // Manejar carga de firma
                $('#seleccionar-firma').click(function () {
                    $('#firma-input').click();
                });

                $('#firma-input').change(function (e) {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('#firma-imagen').attr('src', e.target.result);
                            $('#firma-preview').removeClass('d-none');
                            $('#firma-placeholder').addClass('d-none');
                            $('#eliminar-firma').removeClass('d-none');
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });

                $('#eliminar-firma').click(function () {
                    $('#firma-input').val('');
                    $('#firma-preview').addClass('d-none');
                    $('#firma-placeholder').removeClass('d-none');
                    $(this).addClass('d-none');
                });
                $('#formSancion').on('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Guardar Resolución',
                        text: '¿Está seguro de guardar esta resolución de sanción?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, guardar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const formData = new FormData(this);

                            $.ajax({
                                url: $(this).attr('action'),
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                beforeSend: function () {
                                    $('#btnGuardar').prop('disabled', true)
                                        .html('<i class="fas fa-spinner fa-spin me-2"></i>Guardando...');
                                },
                                success: function (response) {
                                    if (response.success) {
                                        Swal.fire('Éxito', response.message, 'success');
                                        // Opcional: redireccionar o limpiar el formulario
                                        // window.location.href = "{{ route('decano.psr') }}";
                                    } else {
                                        Swal.fire('Error', response.message, 'error');
                                    }
                                },
                                error: function (xhr) {
                                    let errorMsg = 'Ocurrió un error al guardar';
                                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                                        errorMsg = '';
                                        $.each(xhr.responseJSON.errors, function (key, value) {
                                            errorMsg += value + '<br>';
                                        });
                                    }
                                    Swal.fire('Error', errorMsg, 'error');
                                },
                                complete: function () {
                                    $('#btnGuardar').prop('disabled', false)
                                        .html('<i class="fas fa-save me-2"></i>Guardar Resolución');
                                }
                            });
                        }
                    });
                });
                    });
            </script>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formSancion = document.getElementById('formSancion');
            const btnDescargarPDF = document.getElementById('btnDescargarPDF');
            const btnEnviarResolucion = document.getElementById('btnEnviarResolucion');

            // Verificar que los elementos existen
            if (!btnDescargarPDF || !btnEnviarResolucion || !formSancion) {
                console.error('No se encontraron los elementos requeridos');
                return;
            }

            // 1. Evento para Descargar PDF
            btnDescargarPDF.addEventListener('click', function () {
                if (!validarCamposRequeridos()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos incompletos',
                        text: 'Por favor complete todos los campos requeridos',
                    });
                    return;
                }

                // Deshabilitar botón durante la operación
                btnDescargarPDF.disabled = false;
                const originalText = btnDescargarPDF.innerHTML;
                btnDescargarPDF.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generando PDF...';

                // Crear formulario temporal para PDF
                const formTemp = document.createElement('form');
                formTemp.method = 'POST';
                formTemp.action = "{{ route('decano.enviar_resolucion') }}";
                formTemp.target = '_blank'; // Abrir en nueva pestaña

                // Agregar CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";
                formTemp.appendChild(csrfInput);

                // Indicar acción
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'generar_pdf';
                formTemp.appendChild(actionInput);

                // Agregar campos del formulario principal
                const campos = ['id_docente', 'numero_resolucion', 'fecha_emision',
                    'nombre_docente', 'apellido_docente', 'identificacion_docente',
                    'asignatura', 'calificacion_final', 'tipo_sancion',
                    'antecedentes', 'fundamentos', 'resolucion'];

                campos.forEach(campo => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = campo;
                    input.value = document.getElementById(campo)?.value || '';
                    formTemp.appendChild(input);
                });

                // Agregar firma si existe
                const firmaPreview = document.getElementById('firma-preview');
                if (firmaPreview && !firmaPreview.classList.contains('d-none')) {
                    const firmaInput = document.createElement('input');
                    firmaInput.type = 'hidden';
                    firmaInput.name = 'firma';
                    firmaInput.value = document.getElementById('firma-imagen').src;
                    formTemp.appendChild(firmaInput);
                }

                // Enviar formulario
                document.body.appendChild(formTemp);
                formTemp.submit();
                document.body.removeChild(formTemp);

                // Restaurar botón después de 2 segundos
                setTimeout(() => {
                    btnDescargarPDF.disabled = false;
                    btnDescargarPDF.innerHTML = originalText;
                }, 2000);
            });

            // 2. Evento para Enviar Resolución
            btnEnviarResolucion.addEventListener('click', function () {
                if (!validarCamposRequeridos()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos incompletos',
                        text: 'Por favor complete todos los campos requeridos',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirmar envío',
                    text: "¿Está seguro de enviar esta resolución al docente?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, enviar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        enviarResolucion();
                    }
                });
            });

            // Función para enviar resolución
            function enviarResolucion() {
                // Deshabilitar botón durante la operación
                btnEnviarResolucion.disabled = true;
                const originalText = btnEnviarResolucion.innerHTML;
                btnEnviarResolucion.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';

                // Preparar datos del formulario
                const formData = new FormData(formSancion);
                formData.append('action', 'enviar_resolucion');

                // Enviar solicitud AJAX
                fetch("{{ route('decano.enviar_resolucion') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Error en la respuesta del servidor');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: data.message || 'Resolución enviada correctamente',
                            });
                        } else {
                            throw new Error(data.message || 'Error al enviar la resolución');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message,
                        });
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        btnEnviarResolucion.disabled = false;
                        btnEnviarResolucion.innerHTML = originalText;
                    });
            }

            // Función para validar campos requeridos
            function validarCamposRequeridos() {
                const camposRequeridos = [
                    'docenteSelect',        // ID correcto
        'numeroResolucion',     // ID en HTML es 'numeroResolucion' no 'numero_resolucion'
        'fechaEmision',         // ID en HTML es 'fechaEmision' no 'fecha_emision'
        'tipoSancionSelect',    // ID correcto
        'antecedentes',         // ID correcto
        'fundamentos',          // ID correcto
        'resolucion'            // ID correcto
                ];

                let valido = true;

                camposRequeridos.forEach(id => {
                    const elemento = document.getElementById(id);
                    if (!elemento || !elemento.value) {
                        valido = false;
                        elemento.classList.add('is-invalid');

                        // Mostrar mensaje de error si existe
                        const feedback = document.getElementById(`${id}-feedback`);
                        if (feedback) {
                            feedback.style.display = 'block';
                        }
                    } else {
                        elemento.classList.remove('is-invalid');

                        // Ocultar mensaje de error si existe
                        const feedback = document.getElementById(`${id}-feedback`);
                        if (feedback) {
                            feedback.style.display = 'none';
                        }
                    }
                });

                return valido;
            }
        });
    </script>
@endsection