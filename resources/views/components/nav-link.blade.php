@props(['active'])

@php
$classes = ($active ?? false)
?'px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-md transition
duration-150 ease-in-out' : 'px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-blue-500 hover:bg-opacity-75
transition duration-150
ease-in-out'
;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
