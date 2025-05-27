<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Departamento;
use App\Models\Calificacion;
use App\Models\AlertaBajoDesempeno;
use App\Models\Busquedadocente;
use App\Models\Facultad;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ActaCompromiso;
use App\Models\ProcesoSancionRetiro;
use App\Models\Sanciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class DecanoCordinadorController extends Controller
{
    //
    //total_docentes


        public function total_docentes()
    {
        $docentes = DB::select('CALL total_docentes()');
        return view('decano.total_docentes', compact('docentes'));
    }
    //total docentes no evaluados
    public function totalNoEvaluados()
    {
        // Ejecutamos el procedimiento almacenado para obtener el total de docentes no evaluados
        $totalNoEvaluados = DB::select('CALL totalNoEvaluados()');
        $totalNoEvaluados = $totalNoEvaluados[0] ?? null;
        // Pasamos la variable $totalNoEvaluados a la vista
        return view('decano.totalNoEvaluados', compact('totalNoEvaluados'));
    }
    public function totalEstudiantesNoEvaluaron()
    {
        // Ejecutamos el procedimiento almacenado para obtener el total de estudiantes no evaluados
        $totalEstudiantesNoEvaluaron = DB::select('CALL ObtenerTotalEstudiantesNoEvaluaron()');

        // Pasamos la variable $totalEstudiantesNoEvaluaron a la vista
        return view('decano.totalEstudiantesNoEvaluaron', compact('totalEstudiantesNoEvaluaron'));
    }
    //promedio por facultad
    public function promedio_global()
    {
        // Ejecutamos el procedimiento almacenado para obtener el promedio por facultad
        $promedio_global = DB::select('CALL promedio_global()');
        // Pasamos la variable $promedio_global a la vista
        return view('decano.promedio_global', compact('promedio_global'));
    }
    //promedio por facultad

    public function obtenerPromedioPorFacultad() {
        // Ejecutamos el procedimiento almacenado
    $datos = collect(DB::select('CALL ObtenerPromedioPorFacultad()'));
// Asegúrate de que devuelva: facultad, promedio_nota
    $labels = $datos->pluck('facultad');
    $notas = $datos->pluck('promedio_nota');

return view('graficas.facultades', compact('labels', 'promedio_nota'));

}

public function docentesDestacados()
{
    // Ejecutar el procedimiento almacenado
    $docentesUnicos = DB::select('CALL ObtenerDocentesDestacados()');

    // Verificar los datos obtenidos
    dd($docentesUnicos);  // Verifica los datos obtenidos de la base de datos

    // Filtrar los duplicados basados en el nombre del docente
    $docentesUnicos = collect($docentesUnicos)->unique('docente');

    // Verificar los datos después de filtrar duplicados
    dd($docentesUnicos);  // Verifica los datos después de filtrar duplicados

    // Pasar los docentes únicos a la vista
    return view('decano.docentesDestacados', compact('docentesUnicos'));
}
public function mostrarGrafica()
    {
        // Ejecuta el procedimiento almacenado
        $promedios = DB::select('CALL ObtenerPromedioNotasPorFacultad()');

        // Extrae las etiquetas (facultades) y los datos (promedios)
        return view('decano.mostrarGrafica',['evaluaciones' => $promedios]);
    }

    public function mostrarAlertas()
    {
        $alertas = DB::select('CALL ObtenerAlertasCalificacionesCriticas()');

        return view('tu_vista', compact('alertas'));
    }


//docentes destacados

public function acta_compromiso(Request $request)
{
    // Obtener estadísticas
    $totalActas = ActaCompromiso::count();
    $promedioGeneral = ActaCompromiso::avg('promedio_total') ?? 0;
    $actasMes = ActaCompromiso::whereMonth('fecha_generacion', now()->month)->count();
    $actasFirmadas = ActaCompromiso::whereNotNull('firma')->count();

    // Filtrar actas
    $query = ActaCompromiso::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nombre_docente', 'like', "%$search%")
              ->orWhere('apellido_docente', 'like', "%$search%")
              ->orWhere('identificacion_docente', 'like', "%$search%")
              ->orWhere('numero_acta', 'like', "%$search%");
        });
    }

    $actas = $query->orderBy('fecha_generacion', 'desc')->paginate(10);
    $docentesbusqueda = DB::select('CALL BuscarDocente(?)', [request('id_docente')]);

    return view('decano.acta_compromiso', compact(
        'actas',
        'docentesbusqueda',
        'totalActas',
        'promedioGeneral',
        'actasMes',
        'actasFirmadas'
    ));
}

public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'fecha_generacion' => 'required|date',
            'nombre_docente' => 'required|string',
            'apellido_docente' => 'required|string',
            'identificacion_docente' => 'required|string',
            'curso' => 'required|string',
            'promedio_total' => 'required|numeric',
            'retroalimentacion' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $result = DB::select('CALL CreateActaCompromiso(?, ?, ?, ?, ?, ?, ?)', [
            $request->fecha_generacion,
            $request->nombre_docente,
            $request->apellido_docente,
            $request->identificacion_docente,
            $request->curso,
            $request->promedio_total,
            $request->retroalimentacion
        ]);



        return response()->json([
            'success' => true,
            'data' => $result[0],
            'message' => 'Acta de compromiso creada correctamente'
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al crear el acta de compromiso: ' . $e->getMessage()
        ], 500);
    }
}

public function show($id)
{
    try {
        $acta = DB::select('CALL GetActaCompromisoById(?)', [$id]);

        if (empty($acta)) {
            return response()->json(['success' => false, 'message' => 'Acta no encontrada'], 404);
        }

        return view('decano.actas.partials.ver_modal', ['acta' => $acta[0]]);
    } catch (\Exception $e) {
        \Log::error('Error viewing acta: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Error al visualizar el acta'], 500);
    }
    // try {
    //     $acta = DB::select('CALL GetActaCompromisoById(?)', [$id]);

    //     if (empty($acta)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'El acta no fue encontrada'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => $acta[0],
    //         'firma_url' => $acta[0]->firma ? asset('storage/' . $acta[0]->firma) : null
    //     ]);

    // } catch (\Exception $e) {
    //     \Log::error('Error viewing acta: ' . $e->getMessage());
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Error al visualizar el acta'
    //     ], 500);
    // }
}
public function edit($id)
{
    try {
        $acta = DB::select('CALL GetActaCompromisoById(?)', [$id]);

        if (empty($acta)) {
            return redirect()->back()->with('error', 'El acta no fue encontrada');
        }

        // Assuming you have a way to get docentes, maybe from another stored procedure
        $docentes = []; // You should populate this

        return view('decano.actas.editar', [
            'acta' => $acta[0],
            'docentes' => $docentes
        ]);
    } catch (\Exception $e) {
        \Log::error('Error editing acta: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al cargar el formulario de edición');
    }
}

// public function update(Request $request, $id)
// {
//     $validater = $request->validate([
//         'numero_acta' => 'required|unique:acta_compromiso,numero_acta,'.$id,
//         'fecha_generacion' => 'required|date',
//         'nombre_docente' => 'required|string|max:255',
//         'apellido_docente' => 'required|string|max:255',
//         'identificacion_docente' => 'required|string|max:255',
//         'curso' => 'required|string|max:255',
//         'promedio_total' => 'required|numeric|min:0|max:5',
//         'retroalimentacion' => 'required|string',
//         'firma' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
//     ]);

//     try {
//         $firmaPath = null;
//         if ($request->hasFile('firma')) {
//             // Delete old file if exists
//             $oldActa = DB::select('CALL GetActaCompromisoById(?)', [$id]);
//             if ($oldActa[0]->firma_path && Storage::disk('public')->exists($oldActa[0]->firma_path)) {
//                 Storage::disk('public')->delete($oldActa[0]->firma_path);
//             }

//             $firmaPath = $request->file('firma')->store('firmas', 'public');
//         }

//         $result = DB::select('CALL UpdateActaCompromiso(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
//             $id,
//             $request->numero_acta,
//             $request->fecha_generacion,
//             $request->nombre_docente,
//             $request->apellido_docente,
//             $request->identificacion_docente,
//             $request->curso,
//             $request->promedio_total,
//             $request->retroalimentacion,
//             $firmaPath
//         ]);

//         return response()->json([
//             'success' => true,
//             'data' => $result[0],
//             'message' => 'Acta de compromiso actualizada correctamente'
//         ], 200);

//     } catch (\Exception $e) {
//         \Log::error('Error updating acta: ' . $e->getMessage());
//         return response()->json([
//             'success' => false,
//             'message' => 'Error al actualizar el acta de compromiso: ' . $e->getMessage()
//         ], 500);
//     }
// }
public function ver($id)
{
    try {
        $acta = DB::select('CALL GetActaCompromisoById(?)', [$id]);

        if (empty($acta)) {
            return redirect()->back()->with('error', 'El acta no fue encontrada');
        }

        return view('decano.actas.ver', ['acta' => $acta[0]]);
    } catch (\Exception $e) {
        Log::error('Error viewing acta: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al visualizar el acta');
    }
}
public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'numero_acta' => 'required|unique:acta_compromiso,numero_acta,'.$id.',id',
            'fecha_generacion' => 'required|date',
            'nombre_docente' => 'required|string|max:255',
            'apellido_docente' => 'required|string|max:255',
            'identificacion_docente' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'promedio_total' => 'required|numeric|min:0|max:5',
            'retroalimentacion' => 'required|string',
            'firma' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $firmaPath = null;
        if ($request->hasFile('firma')) {
            // Procesar firma...
        }

        $result = DB::select('CALL UpdateActaCompromiso(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $validatedData['numero_acta'],
            $validatedData['fecha_generacion'],
            $validatedData['nombre_docente'],
            $validatedData['apellido_docente'],
            $validatedData['identificacion_docente'],
            $validatedData['curso'],
            $validatedData['promedio_total'],
            $validatedData['retroalimentacion'],
            $firmaPath
        ]);

        return response()->json([
            'success' => true,
            'data' => $result[0],
            'message' => 'Acta de compromiso actualizada correctamente'
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error de validación',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        Log::error('Error updating acta: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar el acta de compromiso: ' . $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    try {
        $acta = DB::select('CALL DeleteActaCompromiso(?)', [$id]);

        return redirect()->route('decano.acta_compromiso')
            ->with('success', 'Acta eliminada correctamente');

    } catch (\Exception $e) {
        return back()->with('error', 'Error al eliminar el acta: ' . $e->getMessage());
    }
}



    //modales seguimiento
    public function seguimiento()
    {
        return view('decano.modales_seguimiento');
    }

    //proseso sancion retiro

    public function psr()

    {

        $docentesbusqueda = DB::select('CALL ObtenerTodosLosDocentes()');

        return view('decano.proceso_sancion_retiro', compact('docentesbusqueda'));
    }




    //seguimiento plan de mejora
    public function spm()
    {

        return view('decano.seguimiento_plan_mejora');
    }

    /**
     * Muestra el formulario para editar un acta de compromiso
     */
    public function editarActa($id)
    {
        // Obtener el acta de compromiso por ID usando el procedimiento almacenado
        $actas = DB::select('CALL GetActaCompromisoById(?)', [$id]);
        $acta = $actas[0] ?? null;

        if (!$acta) {
            return redirect()->route('decano.acta_compromiso')
                ->with('error', 'Acta de compromiso no encontrada');
        }

        // La información del docente ya viene incluida en el resultado del procedimiento almacenado
        $docente = (object)[
            'id_docente' => $acta->id_docente,
            'nombre' => $acta->nombre_docente,
        ];

        return view('decano.editar_acta', compact('acta', 'docente'));
    }

    /**
     * Actualiza un acta de compromiso en la base de datos
     */
    public function ActualizarActa(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'numero_acta' => 'required|string',
            'fecha_generacion' => 'required|date',
            'retroalimentacion' => 'required|string'
        ]);

        // Actualizar el acta en la base de datos usando el procedimiento almacenado
        $result = DB::select('CALL UpdateActaCompromiso(?, ?, ?)', [
            $id,
            $request->retroalimentacion,
            $request->fecha_generacion
        ]);

        // Si se cargó una nueva firma, procesarla y actualizar el campo de firma por separado
        if ($request->hasFile('firma')) {
            $firma = $request->file('firma');
            $nombreFirma = time() . '_' . $firma->getClientOriginalName();
            $firma->move(public_path('firmas'), $nombreFirma);

            // Actualizar solo el campo de firma
            DB::table('acta_compromiso')
                ->where('id_acta', $id)
                ->update(['firma' => '/firmas/' . $nombreFirma]);
        } elseif ($request->has('firma_actual')) {
            // Actualizar solo el campo de firma con el valor actual
            DB::table('acta_compromiso')
                ->where('id_acta', $id)
                ->update(['firma' => $request->firma_actual]);
        }

        return redirect()->route('decano.acta_compromiso')
            ->with('success', 'Acta de compromiso actualizada correctamente');
    }

    public function descargar()
{
    $path = storage_path('app/public/actas/acta_compromiso.pdf'); // Ajusta la ruta según corresponda

    if (!file_exists($path)) {
        abort(404, 'Archivo no encontrado');
    }

    return response()->download($path, 'acta_compromiso.pdf');
}
public function mostrarFormularioSancion()
    {
        // Obtener todos los docentes disponibles para la sanción
        $docentesbusqueda = DB::select('CALL BuscarDocente(?)', ['']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            // "" para traer todos

        return view('decano.formulario_sancion', compact('docentesbusqueda'));
    }
    /**
     * Almacena una nueva sanción en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardarSancion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero_resolucion' => 'required|string|unique:sanciones,numero_resolucion',
            'fecha_emision' => 'required|date',
            'identificacion_docente' => 'required|string|max:20',
            'tipo_sancion' => 'required|string',
            'antecedentes' => 'required|string',
            'fundamentos' => 'required|string',
            'resolucion' => 'required|string',
            'firma' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $firmaPath = null;
        if ($request->hasFile('firma')) {
            $firma = $request->file('firma');
            $firmaName = time() . '_' . $firma->getClientOriginalName();
            $firma->storeAs('public/firmas', $firmaName);
            $firmaPath = 'firmas/' . $firmaName;
        }

        $resultado = DB::select('CALL CreateSancion(?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->id_docente,
            $request->numero_resolucion,
            $request->fecha_emision,
            $request->tipo_sancion,
            $request->antecedentes,
            $request->fundamentos,
            $request->resolucion,
            $firmaPath
        ]);


          return response()->json([
           'success' => true,
           'message' => 'Proceso de sanción creado exitosamente',
          'id_sancion' => $resultado[0]->id_sancion ?? null
          ], 201);
    //     return redirect()
    //     ->route('decano.procesoSancionRetiro')
    // ->with('success', 'Proceso de sanción creado exitosamente');
    }


    /**
     * Muestra la lista de sanciones emitidas.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarSanciones()
    {
        $sanciones = DB::table('proceso_sancion_retiro')
                        ->join('docentes', 'proceso_sancion_retiro.docente_id', '=', 'docentes.id')
                        ->select('proceso_sancion_retiro.*', 'docentes.nombre', 'docentes.apellido', 'docentes.email')
                        ->orderBy('fecha_emision', 'desc')
                        ->paginate(10);

        return response()->view('decano.lista_sanciones', compact('sanciones'));
    }

    /**
     * Genera un PDF de la resolución de sanción.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function generarPDFSancion($id)
    {
        $sancion = DB::table('sanciones')
                    ->join('docentes', 'sanciones.docente_id', '=', 'docentes.id')
                    ->select(
                        'sanciones.*',
                        'docentes.nombre',
                        'docentes.apellido',
                        'docentes.email',
                        'docentes.identificacion',
                        'docentes.departamento',
                        'docentes.telefono'
                    )
                    ->where('sanciones.id', $id)
                    ->first();

        if (!$sancion) {
            abort(404, 'No se encontró la sanción solicitada.');
        }

        try {
            $data = [
                'sancion' => $sancion,
                'fecha_actual' => Carbon::now()->format('d/m/Y'),
                'institucion' => config('app.name'),
                'logo' => public_path('img/logo-institucion.png')
            ];

            $pdf = PDF::loadView('sanciones.pdf', $data)
                     ->setPaper('a4', 'portrait')
                     ->setOptions([
                         'isHtml5ParserEnabled' => true,
                         'isRemoteEnabled' => true
                     ]);

            return $pdf->download('Resolucion_Sancion_' . $sancion->numero_resolucion . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error al generar PDF de sanción ID ' . $id . ': ' . $e->getMessage());
            abort(500, 'Error al generar el PDF. Por favor intente más tarde.');
        }
    }

    /**
     * Envía la resolución de sanción al docente por correo electrónico
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

     public function enviarResolucion(Request $request): JsonResponse
{
   try {
        DB::beginTransaction();

        // Validación completa
        $validated = $request->validate([
             'numero_resolucion' => 'required|string|unique:sanciones,numero_resolucion',
            'fecha_emision' => 'required|date',
            'identificacion_docente' => 'required|string|max:20',
            'tipo_sancion' => 'required|string',
            'antecedentes' => 'required|string',
            'fundamentos' => 'required|string',
            'resolucion' => 'required|string',
            'firma' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Agrega otros campos necesarios
        ]);

        $idDocente = $validated['id_docente'];

        // Buscar la sanción (ajusta según tu lógica)
        $sancion = Sancion::where('docente_id', $idDocente)
            ->with('docente')
            ->latest()
            ->firstOrFail();

        if (empty($sancion->docente->email)) {
            return response()->json([
                'success' => false,
                'message' => 'El docente no tiene email registrado'
            ], 400);
        }

        // Generar PDF
        $pdf = $this->generarPdfSancion($sancion);
        $pdfContent = $pdf->output();
        $pdfFileName = 'Resolucion_Sancion_' . $sancion->numero_resolucion . '.pdf';

        // Enviar email
        Mail::to($sancion->docente->email)
            ->cc('rrhh@institucion.edu')
            ->send(new NotificacionSancion($sancion, $pdfContent, $pdfFileName));

        // Actualizar estado
        $sancion->update([
            'fecha_notificacion' => now(),
            'estado' => 'notificada',
            'notificado_por' => auth()->id()
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Resolución enviada correctamente',
            'pdf_url' => route('descargar.pdf', ['id' => $sancion->id]) // Opcional
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Sanción no encontrada'
        ], 404);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Error enviando resolución: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Error al enviar: ' . $e->getMessage()
        ], 500);
    }
}

// protected function generarPdfSancion($sancion)
// {
//     return PDF::loadView('sanciones.pdf', [
//         'sancion' => $sancion,
//         'fecha_actual' => now()->format('d/m/Y')
//     ]);
// }

protected function enviarEmailNotificacion($sancion, $pdfContent, $filename)
{
    Mail::to($sancion->docente->email)
        ->cc('rrhh@institucion.edu')
        ->send(new NotificacionSancion($sancion, $pdfContent, $filename));
}
    /**
     * Ver detalles de una sanción específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function verSancion($id)
    // {
    //     try {
    //         $sancion = DB::table('proceso_sancion_retiro')
    //                     ->join('docentes', 'proceso_sancion_retiro.docente_id', '=', 'docentes.id')
    //                     ->select('proceso_sancion_retiro.*', 'docentes.nombre', 'docentes.apellido', 'docentes.email')
    //                     ->where('proceso_sancion_retiro.id', $id)
    //                     ->first();

    //         if (!$sancion) {
    //             return back()->with('error', 'No se encontró la sanción solicitada.');
    //         }

    //         return view('decano.ver_sancion', compact('sancion'));
    //     } catch (\Exception $e) {
    //         Log::error('Error al ver sanción: ' . $e->getMessage());
    //         return back()->with('error', 'Ha ocurrido un error al visualizar la sanción: ' . $e->getMessage());
    //     }
    // }

}
