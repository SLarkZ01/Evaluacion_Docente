@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-gray-700 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition duration-200 placeholder-gray-400 shadow-sm hover:border-gray-300']) !!}>
