<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; // <--- Asegúrate de importar esto

class DocenteController extends Controller
{
    //
    public function p_docente()
    {
        $correo = Session::get('correo_usuario');

        // Verificar que el correo esté en la sesión
        if (!$correo) {
            return redirect()->route('login')->with('error', 'Sesión expirada');
        }

        try {
            // Llamar al procedimiento almacenado
            $evaluaciones = DB::select('CALL ObtenerEvaluacionesPorCorreo(?)', [$correo]);
            
            // Si no hay evaluaciones, inicializar como array vacío
            if (empty($evaluaciones)) {
                $evaluaciones = [];
            }
            
        } catch (\Exception $e) {
            // En caso de error, inicializar como array vacío y log del error
            \Log::error('Error al obtener evaluaciones: ' . $e->getMessage());
            $evaluaciones = [];
        }
        
        return view('Docente.panel_docente', compact('evaluaciones'));
    }

    public function confi()
    {
        return view('Docente.configuracion');
    }

    public function pde()
    {
        return view('Docente.panel_docente_enhanced');
    }

    public function result()
    {
        $correo = Session::get('correo_usuario');
        $notasCursos = DB::select('CALL ObtenerCursosPorCorreo(?)', [$correo]);
        return view('Docente.resultados', compact('notasCursos'));
    }
}
