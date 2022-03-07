@props(['active'])

@php
$classes = ($active ?? false)
?'px-3 py-2 text-sm font-medium text-white bg-indigo-700 rounded-md transition
duration-150 ease-in-out' : 'px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75
transition duration-150
ease-in-out'
;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
