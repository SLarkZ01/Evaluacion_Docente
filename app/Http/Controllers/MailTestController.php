<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MailTestController extends Controller
{
    public function showTestForm()
    {
        return view('mail-test');
    }
    
    public function testMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'test_type' => 'required|in:basic,password_reset'
        ]);
        
        $email = $request->email;
        $results = [];
        
        try {
            if ($request->test_type === 'basic') {
                // Test básico de correo
                Mail::raw('Este es un correo de prueba desde el Sistema de Evaluación Docente.', function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Test - Sistema Evaluación Docente');
                });
                
                $results[] = '✓ Correo básico enviado correctamente';
            }
            
            if ($request->test_type === 'password_reset') {
                // Verificar que el usuario existe
                $user = User::where('email', $email)->first();
                
                if (!$user) {
                    $results[] = '✗ Usuario no encontrado con email: ' . $email;
                } else {
                    // Test de reset de contraseña
                    $status = Password::sendResetLink(['email' => $email]);
                    
                    if ($status === Password::RESET_LINK_SENT) {
                        $results[] = '✓ Correo de recuperación de contraseña enviado correctamente';
                    } else {
                        $results[] = '✗ Error al enviar correo de recuperación: ' . __($status);
                    }
                }
            }
            
        } catch (\Exception $e) {
            Log::error('Mail test error: ' . $e->getMessage());
            $results[] = '✗ Error: ' . $e->getMessage();
        }
        
        return back()->with([
            'test_results' => $results,
            'test_email' => $email
        ]);
    }
}
