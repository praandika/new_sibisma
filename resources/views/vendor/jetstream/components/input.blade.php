@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-b-1 border-gray-300 focus:border-indigo-300 rounded-md shadow-sm']) !!}>
