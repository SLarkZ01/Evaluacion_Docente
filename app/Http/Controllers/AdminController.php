<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// metodo para el controlador de administrador
class AdminController extends Controller
{
    public function Dashboard()
    {
        return view('Administrador.panel_admin');
    }
// metodo para el controlador de periodo de evaluacion
    public function periodo_evaluacion(){
        return view('Administrador.periodos_evaluacion');
}
// metodo para el controlador de reportes
public function reportes()
{
    return view('Administrador.reportes_admin');
}
// metodo para el controlador de roles y permisos
public function roles_permisos()
{
     $usuarios = DB::select("CALL ObtenerTodosLosUsuarios()");
    //  \Log::info('Datos de usuarios:', ['usuarios' => $usuarios]);
     \Log::info('Datos de usuarios:', ['usuarios' => $usuarios]);

    // return view('Administrador.Roles_permisos');
    return view('Administrador.Roles_permisos', compact('usuarios'));

}
}
