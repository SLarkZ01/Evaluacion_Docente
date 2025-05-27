@extends('layouts.principal')
@section('titulo', 'Acta de Compromiso')
@section('contenido')

<form id="editActaForm" method="POST" action="{{ route('decano.acta_compromiso.update', $acta->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Número de Acta:</label>
                <input type="text" class="form-control" value="{{ $acta->numero_acta }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha de Generación:</label>
                <input type="date" class="form-control" name="fecha_generacion" value="{{ $acta->fecha_generacion }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre Docente:</label>
                <input type="text" class="form-control" name="nombre_docente" value="{{ $acta->nombre_docente }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Apellido Docente:</label>
                <input type="text" class="form-control" name="apellido_docente" value="{{ $acta->apellido_docente }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Identificación:</label>
                <input type="text" class="form-control" name="identificacion_docente" value="{{ $acta->identificacion_docente }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Curso/Asignatura:</label>
                <input type="text" class="form-control" name="curso" value="{{ $acta->curso }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Promedio:</label>
                <input type="number" step="0.01" min="0" max="5" class="form-control" name="promedio_total" 
                       value="{{ $acta->promedio_total }}" id="editPromedio" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Estado:</label>
                <div class="form-control">
                    <span id="estadoTexto">{{ $acta->promedio_total < 3 ? 'Bajo Desempeño' : ($acta->promedio_total < 4 ? 'Desempeño Regular' : 'Buen Desempeño') }}</span>
                    <span class="badge float-end {{ $acta->promedio_total < 3 ? 'bg-danger' : ($acta->promedio_total < 4 ? 'bg-warning text-dark' : 'bg-success') }}">
                        {{ number_format($acta->promedio_total, 2) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Retroalimentación:</label>
            <textarea class="form-control" name="retroalimentacion" rows="4" required>{{ $acta->retroalimentacion }}</textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Firma Digital:</label>
            <div class="border p-3 text-center">
                @if($acta->firma)
                    <img src="{{ asset('storage/' . $acta->firma) }}" class="img-fluid mb-2" style="max-height: 150px;" id="firmaPreview">
                @else
                    <div class="text-muted py-4" id="firmaPlaceholder">
                        <i class="fas fa-signature fa-3x"></i>
                        <p class="mt-2">No hay firma registrada</p>
                    </div>
                @endif
                <input type="file" class="form-control mt-2" name="firma" id="firmaInput" accept="image/*">
                <small class="text-muted">Dejar en blanco para mantener la firma actual</small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
</form>

<script>
// Actualizar estado del promedio al editar
$('#editPromedio').on('input', function() {
    const promedio = parseFloat($(this).val()) || 0;
    const $badge = $('#estadoTexto').next('.badge');
    
    $('#estadoTexto').text(
        promedio < 3 ? 'Bajo Desempeño' : 
        (promedio < 4 ? 'Desempeño Regular' : 'Buen Desempeño')
    );
    
    $badge.removeClass('bg-danger bg-warning bg-success text-dark')
          .addClass(promedio < 3 ? 'bg-danger' : (promedio < 4 ? 'bg-warning text-dark' : 'bg-success'))
          .text(promedio.toFixed(2));
});

// Vista previa de la firma
$('#firmaInput').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (!$('#firmaPreview').length) {
                $('#firmaPlaceholder').html('<img id="firmaPreview" class="img-fluid mb-2" style="max-height: 150px;">');
            }
            $('#firmaPreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection