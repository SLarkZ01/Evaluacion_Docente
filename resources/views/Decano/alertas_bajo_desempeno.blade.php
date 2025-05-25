@extends('layouts.principal')
@section('titulo', 'Acta de Compromiso')
@section('contenido')

    <div class="container-fluid p-0">
        <div class="row g-0">

            <!-- Contenido principal -->

                    <div class="header-alertas mb-4">
                        <h1 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Alertas de Bajo Desempeño</h1>
                    </div>

                    <!-- Filtros y estadísticas -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-filter me-2"></i>Filtros</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select" id="departamentoSelect">
                                                <option value="">Todos los departamentos</option>
                                                <option value="Ciencias Exactas">Ciencias Exactas</option>
                                                <option value="Ingeniería">Ingeniería</option>
                                                <option value="Humanidades">Humanidades</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select" id="calificacionSelect">
                                                <option value="">Todas las calificaciones</option>
                                                <option value="1">Menor a 2.5</option>
                                                <option value="2">Entre 2.5 y 2.8</option>
                                                <option value="3">Entre 2.8 y 3.0</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <button class="btn btn-primary w-100" id="aplicarFiltros">
                                                <i class="fas fa-search me-2"></i>Aplicar Filtros
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-4 text-center">
                                            <i class="fas fa-exclamation-circle fa-3x"></i>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="card-title text-white">Docentes en Alerta</h5>
                                            <h2 class="mb-0" id="totalAlertas">4</h2>
                                            <p class="mb-0 small">Calificación < 3.0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Listado de alertas -->
                    <div class="row" id="listaAlertas">
                        <!-- Las alertas se cargarán dinámicamente desde JavaScript -->
                    </div>

                    <!-- Plantilla para cuando no hay alertas -->
                    <div class="row d-none" id="sinAlertas">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body sin-alertas">
                                    <i class="fas fa-check-circle fa-4x mb-3 text-success"></i>
                                    <h3>No hay docentes con alertas de bajo desempeño</h3>
                                    <p class="text-muted">Todos los docentes tienen calificaciones superiores a 3.0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/LogicaDecanoCoordinador/alertas_script.js') }}"></script>
@endsection

