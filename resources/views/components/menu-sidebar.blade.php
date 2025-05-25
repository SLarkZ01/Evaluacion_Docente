@php
    $userRole = auth()->user()->rol->nombre ?? 'default';
@endphp

{{-- Elementos comunes para todos los roles --}}
<li class="nav-item {{ request()->routeIs('*.Dashboard', 'user.index', 'docente.p_docente') ? 'active' : '' }}">
    <a href="{{ 
        $userRole == 'Administrador' ? route('Admin.Dashboard') : 
        ($userRole == 'Decano' ? route('user.index') : 
        ($userRole == 'Docente' ? route('docente.p_docente') : '#')) 
    }}">
        <i class="fas fa-home"></i>
        <p>Inicio</p>
    </a>
</li>

<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Herramientas de Gestión</h4>
</li>

{{-- Menú específico para Administrador --}}
@if($userRole == 'Administrador')
    <li class="nav-item {{ request()->routeIs('admin.roles_permisos') ? 'active' : '' }}">
        <a href="{{ route('admin.roles_permisos') }}">
            <i class="fas fa-file-signature"></i>
            <p>Gestión de Roles y Permisos</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.periodo_evaluacion') ? 'active' : '' }}">
        <a href="{{ route('admin.periodo_evaluacion') }}">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Configuración de Periodo</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.reportes_admin') ? 'active' : '' }}">
        <a href="{{ route('admin.reportes_admin') }}">
            <i class="fas fa-chart-line"></i>
            <p>Reportes y Estadísticas</p>
        </a>
    </li>
@endif

{{-- Menú específico para Docente --}}
@if($userRole == 'Docente')
    <li class="nav-item {{ request()->routeIs('docente.result') ? 'active' : '' }}">
        <a href="{{ route('docente.result') }}">
            <i class="fas fa-file-signature"></i>
            <p>Resultados</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('docente.confi') ? 'active' : '' }}">
        <a href="{{ route('docente.confi') }}">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Configuración</p>
        </a>
    </li>
@endif

{{-- Menú específico para Decano/Coordinador --}}
@if($userRole == 'Decano')
    <li class="nav-item {{ request()->routeIs('decano.acta_compromiso') ? 'active' : '' }}">
        <a href="{{ route('decano.acta_compromiso') }}">
            <i class="fas fa-file-signature"></i>
            <p>Actas de Compromiso</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('decano.abd') ? 'active' : '' }}">
        <a href="{{ route('decano.abd') }}">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Alertas Bajo Desempeño</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('decano.spm') ? 'active' : '' }}">
        <a href="{{ route('decano.spm') }}">
            <i class="fas fa-chart-line"></i>
            <p>Seguimiento Plan de Mejora</p>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('decano.psr') ? 'active' : '' }}">
        <a href="{{ route('decano.psr') }}">
            <i class="fas fa-user-times"></i>
            <p>Proceso de Sanción</p>
        </a>
    </li>
@endif

{{-- Sección de configuración para todos los roles --}}
<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Sesión</h4>
</li>

<li class="nav-item">
    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <p>Cerrar Sesión</p>
    </a>
</li>