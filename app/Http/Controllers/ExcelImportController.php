<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InsercionTablasDatosController;
use Exception;

class ExcelImportController extends Controller
{
    public function importar(Request $request)
    {
        try {
            $request->validate([
                'archivo' => 'required|file|mimes:xlsx,xls,csv',
                'tipo_datos' => 'required|in:evaluaciones,programas,estudiantes'
            ]);

            // Obtener el archivo
            $file = $request->file('archivo');
            $tipo = $request->input('tipo_datos');

            // Inicializar el controlador de inserción
            $controller = new InsercionTablasDatosController();
            $datos = null;

            // Procesar el archivo según el tipo de datos
            switch ($tipo) {
                case 'evaluaciones':
                    $datos = $this->procesarExcel($file, 'TOTAL PROMEDIOS');
                    if (!empty($datos)) {
                        // Aquí iría la lógica para procesar evaluaciones
                        // Por ahora solo registramos el éxito
                        $mensaje = 'Evaluaciones procesadas correctamente';
                    }
                    break;

                case 'programas':
                    $datos = $this->procesarExcel($file, 'Programas');
                    if (!empty($datos)) {
                        $controller->InsertarProgramas($datos);
                        $mensaje = 'Programas importados correctamente';
                    }
                    break;

                case 'estudiantes':
                    $datosEstudiantes = $this->procesarExcel($file, 'Estudiantes');
                    $datosDocentes = $this->procesarExcel($file, 'Docente');
                    $datosCursos = $this->procesarExcel($file, 'Cursos');

                    $mensaje = [];

                    // Procesar cada tipo de dato en orden
                    if (!empty($datosDocentes)) {
                        $controller->InsertarDocentes($datosDocentes);
                        $mensaje[] = 'Docentes importados correctamente';
                    }
                    if (!empty($datosCursos)) {
                        $controller->InsertarCurso($datosCursos);
                        $mensaje[] = 'Cursos importados correctamente';
                    }
                    if (!empty($datosEstudiantes)) {
                        $controller->InsertarEstudiantes($datosEstudiantes);
                        $mensaje[] = 'Estudiantes importados correctamente';
                    }

                    $mensaje = implode(', ', $mensaje);
                    break;
            }

            if (empty($mensaje)) {
                throw new Exception('No se encontraron datos válidos para importar');
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['mensaje' => $mensaje], 200);
            }

            return redirect()->back()->with('success', $mensaje);
        } catch (Exception $e) {
            $error = 'Error al importar: ' . $e->getMessage();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => $error], 500);
            }

            return redirect()->back()->with('error', $error);
        }
    }

    /**
     * Procesa un archivo CSV
     */
    private function procesarCSV($file)
    {
        $datos = [];
        $handle = fopen($file->getRealPath(), 'r');

        if ($handle !== false) {
            // Leer línea por línea
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $datos[] = $data;
            }
            fclose($handle);
        }

        return $datos;
    }

    /**
     * Procesa un archivo Excel usando funciones nativas
     */
    private function procesarExcel($file, $nombreHoja)
    {
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $hoja = $spreadsheet->getSheetByName($nombreHoja);

            if (!$hoja) {
                // Si no encuentra la hoja por nombre, intentar obtener por índice
                $hojas = $spreadsheet->getSheetNames();
                foreach ($hojas as $index => $nombre) {
                    if (strpos(strtolower($nombre), strtolower($nombreHoja)) !== false) {
                        $hoja = $spreadsheet->getSheet($index);
                        break;
                    }
                }

                if (!$hoja) {
                    return null; // Retornamos null en lugar de lanzar excepción
                }
            }

            // Detectar la última fila y columna con datos reales
            $ultimaFila = $hoja->getHighestDataRow();
            $ultimaColumna = $hoja->getHighestDataColumn();

            // Determinar el inicio del rango según el tipo de datos
            $inicio = match ($nombreHoja) {
                'TOTAL PROMEDIOS' => 'A6',        // Para evaluaciones
                'Docente' => 'A2',                // Para datos de docentes
                'Estudiantes' => 'A2',            // Para datos de estudiantes
                'Cursos' => 'A2',                 // Para datos de cursos
                'Programas' => 'A2',              // Para datos de programas
                default => 'A2'
            };

            // Armar el rango dinámico
            $rango = "{$inicio}:{$ultimaColumna}{$ultimaFila}";

            // Leer los datos del rango y filtrar filas vacías
            $datos = array_filter($hoja->rangeToArray(
                $rango,
                null,
                true,    // Calcular formulas
                false,   // No incluir estilos
                true     // Devolver como valores numerados
            ), function ($fila) {
                return !empty(array_filter($fila, function ($celda) {
                    return $celda !== null && $celda !== '';
                }));
            });

            return empty($datos) ? null : array_values($datos); // Retornar null si no hay datos

        } catch (Exception $e) {
            // Retornamos null en caso de error
            return null;
        }
    }
}
