<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class TestMail extends Command
{
    protected $signature = 'mail:test {email}';
    protected $description = 'Test mail configuration and password reset functionality';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing mail configuration...");
        
        try {
            // Test básico de correo
            Mail::raw('Test email from Laravel', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email - Sistema Evaluación Docente');
            });
            
            $this->info("✓ Basic email test sent successfully");
            
            // Test de password reset
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("User with email {$email} not found");
                return;
            }
            
            $status = Password::sendResetLink(['email' => $email]);
            
            if ($status === Password::RESET_LINK_SENT) {
                $this->info("✓ Password reset email sent successfully");
            } else {
                $this->error("✗ Password reset failed: " . __($status));
            }
            
        } catch (\Exception $e) {
            $this->error("✗ Mail test failed: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
        }
    }
}
