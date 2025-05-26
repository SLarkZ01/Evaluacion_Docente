<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Configuración de Correo</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .container { background: #f8f9fa; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        button { background: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
        .results { margin-top: 20px; padding: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        h1 { color: #333; text-align: center; margin-bottom: 30px; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Test de Configuración de Correo</h1>
        
        <div class="info">
            <strong>Información:</strong> Esta página te permite probar la configuración de correo de tu aplicación Laravel.
            Úsala para verificar que la recuperación de contraseñas funcione correctamente.
        </div>

        <form method="POST" action="{{ route('mail.test') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email de prueba:</label>
                <input type="email" id="email" name="email" 
                       value="{{ old('email', session('test_email', 'tmontoyamagon11@gmail.com')) }}" 
                       required>
            </div>

            <div class="form-group">
                <label for="test_type">Tipo de test:</label>
                <select id="test_type" name="test_type" required>
                    <option value="basic">Correo básico</option>
                    <option value="password_reset">Recuperación de contraseña</option>
                </select>
            </div>

            <button type="submit">Ejecutar Test</button>
        </form>

        @if(session('test_results'))
            <div class="results">
                <h3>Resultados del Test:</h3>
                @foreach(session('test_results') as $result)
                    <div class="{{ str_contains($result, '✗') ? 'error' : 'success' }}" style="margin-bottom: 10px; padding: 10px;">
                        {{ $result }}
                    </div>
                @endforeach
            </div>
        @endif

        @if($errors->any())
            <div class="results error">
                <h3>Errores:</h3>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px;">
            <h3>Configuración Actual de Correo:</h3>
            <ul>
                <li><strong>Mailer:</strong> {{ config('mail.default') }}</li>
                <li><strong>Host:</strong> {{ config('mail.mailers.smtp.host') }}</li>
                <li><strong>Puerto:</strong> {{ config('mail.mailers.smtp.port') }}</li>
                <li><strong>Usuario:</strong> {{ config('mail.mailers.smtp.username') ? 'Configurado' : 'No configurado' }}</li>
                <li><strong>Contraseña:</strong> {{ config('mail.mailers.smtp.password') ? 'Configurada' : 'No configurada' }}</li>
                <li><strong>Encriptación:</strong> {{ config('mail.mailers.smtp.encryption') }}</li>
                <li><strong>From Address:</strong> {{ config('mail.from.address') }}</li>
            </ul>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">← Volver al Login</a>
        </div>
    </div>
</body>
</html>
