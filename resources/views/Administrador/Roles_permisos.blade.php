@extends('layouts.principal')
@section('titulo', 'Panel de Administrador')
@section('contenido')
    <!-- jQuery primero -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (requerido para Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Font Awesome para los íconos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Encabezado con colores azules cálidos -->
        <div class="header-card animated-card bg-gradient-primary">
            <h1><i class="fas fa-users-cog me-3"></i>Gestión de Usuarios y Permisos</h1>
            <p class="text-light">Administra los usuarios del sistema y sus niveles de acceso</p>
        </div>

        <!-- Contenedor principal con fondo azul claro -->
        <div class="col-12 p-4 bg-light-blue rounded-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 text-primary-dark">
                    <i class="fas fa-list-alt me-2"></i>Lista de Usuarios
                </h4>
                <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#nuevoUsuarioModal">
                    <i class="fas fa-plus me-2"></i>Nuevo Usuario
                </button>
            </div>

            <!-- Tabla de usuarios con estilo azul -->
            <div class="table-responsive">
                <table class="table table-hover datatable table-striped table-blue">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody><!-- Iterar sobre los usuarios y mostrar en la tabla -->
                         @if(isset($usuarios) && count($usuarios) > 0)
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id_usuario }}</td>
                            <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                            <td>{{ $usuario->tipo_usuario }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>
                                <span class="badge role-badge role-{{ strtolower($usuario->tipo_usuario) }}">
                                    {{ ucfirst($usuario->tipo_usuario) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $usuario->activo ? 'bg-success' : 'bg-danger' }}">
                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-primary-blue btn-edit" 
                                            data-id="{{ $usuario->id_usuario }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editarUsuarioModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-delete" 
                                            data-id="{{ $usuario->id_usuario }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="btn btn-outline-info btn-permissions" 
                                            data-id="{{ $usuario->id_usuario }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#permisosUsuarioModal">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        @endforeach
                         @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Nuevo Usuario - Estilo azul -->
<div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="nuevoUsuarioModalLabel" aria-hidden="true">
{{-- <div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-hidden="true"> --}}
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-primary-blue">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Crear Nuevo Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="nuevoUsuarioForm" method="POST" action="{{ route('usuarios.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido*</label>
                            <input type="text" class="form-control" name="apellido" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="identificacion" class="form-label">Identificación*</label>
                            <input type="text" class="form-control" name="identificacion" required>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico*</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contrasena" class="form-label">Contraseña*</label>
                            <input type="password" class="form-control" name="contrasena" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label for="id_rol" class="form-label">Rol*</label>
                            <select class="form-select" name="id_rol" required>
                                <option value="">Seleccionar rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Coordinador</option>
                                <option value="3">Docente</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tipo_usuario" class="form-label">Tipo de Usuario*</label>
                            <select class="form-select" name="tipo_usuario" required>
                                <option value="administrador">Administrador</option>
                                <option value="coordinador">Coordinador</option>
                                <option value="docente">Docente</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Estado*</label>
                            <select class="form-select" name="activo" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-blue" data-bs-dismiss="modal">
                        <i class="fas fa-save me-2"></i>Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-primary-blue">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Actualizar Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editarUsuarioForm" method="PUT" action="{{ route('usuarios.update') }}">
                @csrf
              @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido*</label>
                            <input type="text" class="form-control" name="apellido" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="identificacion" class="form-label">Identificación*</label>
                            <input type="text" class="form-control" name="identificacion" required>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico*</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contrasena" class="form-label">Contraseña*</label>
                            <input type="password" class="form-control" name="contrasena" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label for="id_rol" class="form-label">Rol*</label>
                            <select class="form-select" name="id_rol" required>
                                <option value="">Seleccionar rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Coordinador</option>
                                <option value="3">Docente</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tipo_usuario" class="form-label">Tipo de Usuario*</label>
                            <select class="form-select" name="tipo_usuario" required>
                                <option value="administrador">Administrador</option>
                                <option value="coordinador">Coordinador</option>
                                <option value="docente">Docente</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Estado*</label>
                            <select class="form-select" name="activo" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-blue" data-bs-dismiss="modal">
                        <i class="fas fa-save me-2"></i>Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Contenido similar al modal de nuevo usuario pero para edición -->
</div>

<!-- Modal para Permisos de Usuario -->
<div class="modal fade" id="permisosUsuarioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-info">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-key me-2"></i>Gestión de Permisos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Usuario: <span id="nombreUsuarioPermisos"></span></h6>
                        <p class="text-muted">Seleccione los permisos para este usuario</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light-blue">
                                <h6 class="mb-0">Permisos Disponibles</h6>
                            </div>
                            <div class="card-body">
                                <div class="row" id="listaPermisos">
                                    <!-- Los permisos se cargarán dinámicamente via AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary-blue" id="guardarPermisosBtn">
                    <i class="fas fa-save me-2"></i>Guardar Permisos
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
$(document).ready(function() {
    // Inicializar DataTable
    $('.datatable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
    });

    // Manejar el envío del formulario de nuevo usuario
    $('#nuevoUsuarioForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Guardando...');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#nuevoUsuarioModal').modal('hide');
                    form[0].reset();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error al guardar el usuario';
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = 'Errores de validación:<br>';
                    for(const field in errors) {
                        errorMessage += `- ${errors[field][0]}<br>`;
                    }
                } else if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                toastr.error(errorMessage);
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Manejar clic en botón de editar
    $('.btn-edit').on('click', function() {
        const userId = $(this).data('id');
        // Cargar datos del usuario via AJAX y mostrar en modal de edición
        $.get(`/usuarios/${userId}`, function(response) {
            if(response.success) {
                const user = response.data;
                // Rellenar formulario de edición con los datos del usuario
                $('#editarUsuarioModal').modal('show');
            } else {
                toastr.error(response.message);
            }
        }).fail(function() {
            toastr.error('Error al cargar los datos del usuario');
        });
    });

    // Manejar clic en botón de eliminar
    $('.btn-delete').on('click', function() {
        const userId = $(this).data('id');
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrá revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/usuarios/${userId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.success) {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Error al eliminar el usuario');
                    }
                });
            }
        });
    });

    // Manejar clic en botón de permisos
    $('.btn-permissions').on('click', function() {
        const userId = $(this).data('id');
        
        // Cargar datos del usuario y sus permisos
        $.get(`/usuarios/${userId}`, function(userResponse) {
            if(userResponse.success) {
                const user = userResponse.data;
                $('#nombreUsuarioPermisos').text(user.nombre + ' ' + user.apellido);
                
                // Cargar todos los permisos disponibles
                $.get('/permisos', function(permsResponse) {
                    if(permsResponse.success) {
                        const permisos = permsResponse.data;
                        const userPermisos = user.permisos || [];
                        
                        let html = '';
                        permisos.forEach(permiso => {
                            const tienePermiso = userPermisos.some(up => up.id === permiso.id);
                            html += `
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input permiso-checkbox" 
                                           type="checkbox" 
                                           id="permiso-${permiso.id}" 
                                           value="${permiso.id}"
                                           ${tienePermiso ? 'checked' : ''}>
                                    <label class="form-check-label" for="permiso-${permiso.id}">
                                        ${permiso.nombre}
                                    </label>
                                    <small class="d-block text-muted">${permiso.descripcion}</small>
                                </div>
                            </div>`;
                        });
                        
                        $('#listaPermisos').html(html);
                        $('#permisosUsuarioModal').modal('show');
                    } else {
                        toastr.error(permsResponse.message);
                    }
                }).fail(function() {
                    toastr.error('Error al cargar los permisos');
                });
            } else {
                toastr.error(userResponse.message);
            }
        }).fail(function() {
            toastr.error('Error al cargar los datos del usuario');
        });
    });

    // Guardar permisos del usuario
    $('#guardarPermisosBtn').on('click', function() {
        const userId = $('.btn-permissions.active').data('id');
        const permisosSeleccionados = [];
        
        $('.permiso-checkbox:checked').each(function() {
            permisosSeleccionados.push($(this).val());
        });
        
        $.ajax({
            url: `/usuarios/${userId}/permisos`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                permisos: permisosSeleccionados
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#permisosUsuarioModal').modal('hide');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Error al guardar los permisos');
            }
        });
    });
});
</script>

<style>
/* Estilos personalizados con colores azules cálidos */
.bg-primary-blue {
    background-color: #2c7be5;
}
.bg-light-blue {
    background-color: #e6f0ff;
}
.text-primary-dark {
    color: #1a5cb0;
}
.btn-primary-blue {
    background-color: #2c7be5;
    border-color: #2c7be5;
    color: white;
}
.btn-primary-blue:hover {
    background-color: #1a5cb0;
    border-color: #1a5cb0;
}
.btn-outline-primary-blue {
    border-color: #2c7be5;
    color: #2c7be5;
}
.btn-outline-primary-blue:hover {
    background-color: #2c7be5;
    color: white;
}
.border-primary-blue {
    border-color: #2c7be5 !important;
}
.table-blue thead th {
    background-color: #2c7be5;
    color: white;
}
.role-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 500;
}
.role-administrador {
    background-color: #e63757;
    color: white;
}
.role-coordinador {
    background-color: #00d97e;
    color: white;
}
.role-docente {
    background-color: #6e84a3;
    color: white;
}
</style>
@endsection