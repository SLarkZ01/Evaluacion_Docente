@php
    $userRole = auth()->user()->rol->nombre ?? 'Usuario';
    $userName = auth()->user()->name ?? 'Usuario';
@endphp

<span>
    {{ $userName }}
    <span class="user-level">{{ $userRole }}</span>
    <span class="caret"></span>
</span>