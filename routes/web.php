<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ActaCompromisoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\DecanoCordinadorController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportarController;
use App\Http\Controllers\ImportarExcelController;
use App\Http\Controllers\ImportarEvaluacionController;

/*
|--------------------------------------------------------------------------
| Configuración de Rutas Web
|--------------------------------------------------------------------------
|
| Este archivo define todas las rutas web de la aplicación de Evaluación Docente.
| Las rutas están organizadas por roles de usuario (público, docente, decano, admin)
| y agrupadas por funcionalidad para una mejor organización y mantenimiento.
|
*/

// Rutas públicas - Accesibles sin autenticación
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas para test de correo (solo en desarrollo)
Route::get('/mail-test', [App\Http\Controllers\MailTestController::class, 'showTestForm'])->name('mail.test.form');
Route::post('/mail-test', [App\Http\Controllers\MailTestController::class, 'testMail'])->name('mail.test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de importación de Excel (Todo el mundo puede acceder)
Route::get('/cargar-excel', function () {
    return view('cargar-excel');
})->name('cargar-excel');

Route::post('/importar', [ExcelImportController::class, 'importar'])->name('importar');

// Rutas de gestión de perfil - Accesibles para todos los usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rutas para docentes - Acceso exclusivo para usuarios con rol 'docente'
// Incluye funcionalidades de configuración, plan de mejoramiento y visualización de resultados
Route::middleware(['auth', 'role:docente'])->prefix('docente')->group(function () {
    Route::get("/", [DocenteController::class, 'p_docente'])->name('docente.p_docente');
    Route::get("/configuracion", [DocenteController::class, 'confi'])->name('docente.confi');
    Route::get("/PDmejorado", [DocenteController::class, 'pde'])->name('docente.pde');
    Route::get("/resultados", [DocenteController::class, 'result'])->name('docente.result');
});

// Rutas para decano - Acceso exclusivo para usuarios con rol 'decano'
// Gestión de actas de compromiso, seguimiento docente y estadísticas
Route::middleware(['auth', 'role:decano'])->prefix('decano')->group(function () {
    // Panel principal del decano
    Route::get("/", [HomeController::class, 'index'])->name('user.index');
    
    // Gestión de actas de compromiso - CRUD y acciones específicas
    Route::prefix('acta-compromiso')->name('decano.')->group(function () {
        Route::get('/', [DecanoCordinadorController::class, 'acta_compromiso'])->name('acta_compromiso');
        Route::get('/{id}/editar', [DecanoCordinadorController::class, 'editar_acta'])->name('editar_acta');
        Route::put('/{id}', [DecanoCordinadorController::class, 'actualizar_acta'])->name('actualizar_acta');
        Route::delete('/{id}', [DecanoCordinadorController::class, 'eliminar_acta'])->name('eliminar_acta');
        Route::put('/{id}/enviar', [DecanoCordinadorController::class, 'enviar_acta'])->name('enviar_acta');
    });
    
    // Sistema de alertas y seguimiento docente
    // Incluye monitoreo de bajo desempeño y procesos de mejora
    Route::get('/alertasBajoDesempeno', [DecanoCordinadorController::class, 'abd'])->name('decano.abd');
    Route::get('/modalesSeguimiento', [DecanoCordinadorController::class, 'seguimiento'])->name('decano.seguimiento');
    Route::get('/procesoSancionRetiro', [DecanoCordinadorController::class, 'psr'])->name('decano.psr');
    Route::get('/seguimientoPlanMejora', [DecanoCordinadorController::class, 'spm'])->name('decano.spm');
    
    // Estadísticas y reportes de evaluación
    // Visualización de métricas, promedios y análisis de resultados
    Route::get('/total_docente', [DecanoCordinadorController::class, 'total_Docentes'])->name('decanato.total_docentes');
    Route::get('/totalNoEvaluados', [DecanoCordinadorController::class, 'totalNoEvaluados'])->name('decano.totalNoEvaluados');
    Route::get('/totalEstudiantesNoEvaluaron', [DecanoCordinadorController::class, 'totalEstudiantesNoEvaluaron'])->name('decano.totalEstudiantesNoEvaluaron');
    Route::get('/promedio_global', [DecanoCordinadorController::class, 'promedio_global'])->name('decano.promedio_global');
    Route::get('/promedio-facultad-ultimo-periodo', [DecanoCordinadorController::class, 'obtenerPromedioPorFacultad']);
    Route::get('/promedio-facultad', [DecanoCordinadorController::class, 'mostrarGraficoFacultades'])->name('decano.mostrarGraficoFacultades');
    Route::get('/docentesDestacados', [DecanoCordinadorController::class, 'obtenerDocentesDestacados'])->name('decano.docentesdestacados');
    Route::get('/grafica-promedios', [DecanoCordinadorController::class, 'mostrarGrafica']);
    Route::get('/alertas', [DecanoCordinadorController::class, 'index']);
    
    // Gestión de búsqueda y administración de docentes
    // Incluye funcionalidades de búsqueda y edición de información docente
    Route::get('/buscar-docente', [DecanoCordinadorController::class, 'buscarDocente'])->name('decano.buscarDocente');
    Route::get('/editar-acta/{id_acta}', [DecanoCordinadorController::class, 'editarActa'])->name('decano.editar_acta');
    Route::put('/actualizar-acta/{id_acta}', [DecanoCordinadorController::class, 'actualizarActa'])->name('decano.actualizar_acta');
    Route::get('/descargar', [DecanoCordinadorController::class, 'descargar'])->name('descargar.acta_compromiso');
    Route::get('/actaCompromiso', [DecanoCordinadorController::class, 'acta_compromiso'])->name('decano.acta_compromiso');
    Route::get('/acta-compromiso', [DecanoCordinadorController::class, 'mostrar_formulario_acta'])->name('actas.formulario');
    Route::get('/actas', [DecanoCordinadorController::class, 'listar_actas'])->name('actas.index');
    
    // Sistema de sanciones - Gestión completa del proceso sancionatorio
    Route::prefix('sanciones')->group(function () {
        Route::get('/formulario', [DecanoCordinadorController::class, 'mostrarFormularioSancion'])->name('formulario_sancion');
        Route::post('/guardar', [DecanoCordinadorController::class, 'guardarSancion'])->name('guardar_sancion');
        Route::get('/', [DecanoCordinadorController::class, 'listarSanciones'])->name('sanciones');
        Route::get('/{id}', [DecanoCordinadorController::class, 'verDetalleSancion'])->name('ver_sancion');
        Route::get('/{id}/pdf', [DecanoCordinadorController::class, 'generarPdfSancion'])->name('generar_pdf_sancion');
        Route::post('/{id}/enviar', [DecanoCordinadorController::class, 'enviarResolucionDocente'])->name('enviar_resolucion');
        Route::post('/enviar-ajax', [DecanoCordinadorController::class, 'enviarResolucionAjax'])->name('enviar_resolucion_ajax');
    });
});

// Rutas específicas para actas de compromiso - Módulo independiente
// Accesible solo para decanos, incluye gestión completa de actas
Route::middleware(['auth', 'role:decano'])->prefix('actas-compromisos')->group(function () {
    Route::get('/', [ActaCompromisoController::class, 'index'])->name('actas.compromiso.index');
    Route::post('/guardar', [DecanoCordinadorController::class, 'store'])->name('actas.compromiso.store');
    Route::get('/filtrar-docentes', [DecanoCordinadorController::class, 'filtrarDocentes'])->name('actas.compromiso.filtrar');
    Route::get('/docente/{id}', [DecanoCordinadorController::class, 'obtenerDocente'])->name('actas.compromiso.docente');
    Route::get('/listar', [DecanoCordinadorController::class, 'listar'])->name('actas.compromiso.listar');
    Route::get('/ver/{id}', [DecanoCordinadorController::class, 'ver'])->name('actas.compromiso.ver');
});

// Rutas para actas de compromiso
Route::prefix('actas-compromiso')->group(function () {
    Route::get('/', [DecanoCordinadorController::class, 'acta_compromiso'])->name('decano.acta_compromiso');
    Route::post('/', [DecanoCordinadorController::class, 'store'])->name('decano.acta_compromiso.store');
    Route::get('/ver/{id}', [DecanoCordinadorController::class, 'ver'])->name('decano.ver_acta');
    Route::get('/editar/{id}', [DecanoCordinadorController::class, 'edit'])->name('decano.acta_compromiso.edit');
    Route::put('/{id}', [DecanoCordinadorController::class, 'update'])->name('decano.acta_compromiso.update'); // Cambiado a PUT directo
    Route::delete('/eliminar/{id}', [DecanoCordinadorController::class, 'destroy'])->name('decano.acta_compromiso.destroy');
});

// Rutas para administrador - Acceso exclusivo para usuarios con rol 'admin'
// Incluye configuración del sistema, gestión de períodos y reportes generales
Route::middleware(['auth', 'role:admin'])->prefix('Admin')->group(function () {
    // Panel de administración y configuración general
    Route::get('/', [AdminController::class, 'Dashboard'])->name('Admin.Dashboard');
    Route::get('/periodo_evaluacion', [AdminController::class, 'periodo_evaluacion'])->name('admin.periodo_evaluacion');
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('admin.reportes_admin');
    Route::get('/roles_permisos', [AdminController::class, 'roles_permisos'])->name('admin.roles_permisos');
});

// // Rutas para la funcionalidad de Sanciones
// Route::middleware(['decano/procesoSancionRetiro'])->prefix('decano')->name('decano.')->group(function () {
    // Mostrar formulario de sanción
Route::prefix('decano')->name('decano.')->group(function () {
    Route::get('/sanciones/formulario', [DecanoCordinadorController::class, 'mostrarFormularioSancion'])->name('formulario_sancion');

    // Guardar sanción
    Route::post('procesoSancionRetiro/guardar', [DecanoCordinadorController::class, 'guardarSancion'])->name('guardar_sancion');

    // Listar sanciones
    Route::get('/sanciones', [DecanoCordinadorController::class, 'listarSanciones'])->name('sanciones');

    // Ver detalle de sanción
    Route::get('/sanciones/{id}', [DecanoCordinadorController::class, 'verDetalleSancion'])->name('ver_sancion');

    // Generar PDF de sanción
    // Route::get('/sanciones/{id}/pdf', [DecanoCordinadorController::class, 'generarPdfSancion'])->name('generar_pdf_sancion');

    // Enviar resolución al docente
    Route::post('/sanciones/{id}/enviar', [DecanoCordinadorController::class, 'enviarResoluciones'])->name('enviar_resoluciones');

   Route::post('/sanciones/enviar-ajax', [DecanoCordinadorController::class, 'enviarResolucion'])
     ->name('enviar_resolucion');
    // Endpoint AJAX para enviar resolución
    // Route::post('/sanciones/enviar-ajax', [DecanoCordinadorController::class, 'enviarResolucioniu'])->name('enviar_resolucion_ajax');
// });
 Route::get('/sanciones/generar-pdf-temp', [DecanoCordinadorController::class, 'generarPDFSancion'])
         ->name('generar_pdf_sancion');

    // Enviar resolución AJAX
    // Route::post('/sanciones/enviar-ajax', [DecanoCordinadorController::class, 'enviarResolucionAjax'])
    //      ->name('enviar_resolucion_ajax');
});

//Login
Route::post('/login', [loginController::class, 'validation'])->name('login.process');

Route::get('/loginold', [loginController::class, 'Login'])->name('user.login');