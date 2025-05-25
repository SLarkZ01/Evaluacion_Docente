@extends('layouts.principal')
@section('titulo', 'Editar Perfil')
@section('contenido')

<!-- Encabezado y bienvenida -->
<div class="header-card animated-card">
    <h1>Editar Perfil</h1>
    <p class="text-muted">Actualice su información personal y configuración de cuenta</p>
</div>

<div class="row">
    <!-- Información de perfil -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Información de perfil</h4>
                <p class="card-category">Actualice la información de perfil y la dirección de correo electrónico de su cuenta.</p>
            </div>
            <div class="card-body">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="mt-3">
                    @csrf
                    @method('patch')

                    <div class="form-group mb-3">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', auth()->user()->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Correo electrónico</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required autocomplete="username">
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                            <div class="mt-2">
                                <p class="text-sm text-muted">
                                    Su dirección de correo electrónico no está verificada.

                                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-primary">
                                        Haga clic aquí para reenviar el correo de verificación.
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-success">
                                        Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-success ms-3">Guardado.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Actualizar contraseña -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Actualizar Contraseña</h4>
                <p class="card-category">Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantener su seguridad.</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-3">
                    @csrf
                    @method('put')

                    <div class="form-group mb-3">
                        <label for="current_password">Contraseña actual</label>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Nueva Contraseña</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>

                        @if (session('status') === 'password-updated')
                            <p class="text-success ms-3">Guardado.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Eliminar cuenta -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h4 class="card-title">Eliminar Cuenta</h4>
                <p class="card-category">Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente.</p>
            </div>
            <div class="card-body">
                <p>Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.</p>
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                    Eliminar Cuenta
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar cuenta -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">¿Estás segur@ de que quieres eliminar tu cuenta?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente. Por favor ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.</p>
                
                <form method="post" action="{{ route('profile.destroy') }}" id="delete-account-form">
                    @csrf
                    @method('delete')
                    
                    <div class="form-group mb-3">
                        <label for="delete-password">Contraseña</label>
                        <input id="delete-password" name="password" type="password" class="form-control" placeholder="Contraseña" required>
                        @error('password', 'userDeletion')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-account-form').submit();">Eliminar Cuenta</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Mostrar el modal automáticamente si hay errores de validación
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->userDeletion->isNotEmpty())
            var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            deleteModal.show();
        @endif
    });
</script>
@endpush