<div class="modal-body">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Número de Acta:</label>
            <p class="form-control-plaintext">{{ $acta->numero_acta }}</p>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Fecha de Generación:</label>
            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($acta->fecha_generacion)->format('d/m/Y') }}</p>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Docente:</label>
            <p class="form-control-plaintext">{{ $acta->nombre_docente }} {{ $acta->apellido_docente }}</p>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Identificación:</label>
            <p class="form-control-plaintext">{{ $acta->identificacion_docente }}</p>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Curso/Asignatura:</label>
            <p class="form-control-plaintext">{{ $acta->curso }}</p>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Promedio:</label>
            <p class="form-control-plaintext">
                <span class="badge {{ $acta->promedio_total < 3 ? 'bg-danger' : ($acta->promedio_total < 4 ? 'bg-warning text-dark' : 'bg-success') }}">
                    {{ number_format($acta->promedio_total, 2) }}
                </span>
            </p>
        </div>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Retroalimentación:</label>
        <div class="border p-3 rounded bg-light">{{ $acta->retroalimentacion }}</div>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-bold">Firma Digital:</label>
        <div class="text-center">
            @if($acta->firma)
                <img src="{{ asset('storage/' . $acta->firma) }}" class="img-fluid mb-2" style="max-height: 150px;">
            @else
                <div class="text-muted py-4 border rounded">
                    <i class="fas fa-signature fa-4x"></i>
                    <p class="mt-2">No se ha registrado firma digital</p>
                </div>
            @endif
        </div>
    </div>
</div>