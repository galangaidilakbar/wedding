@props(['color'])

@php
    switch ($color) {
        case 'red':
            $classes = 'bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300';
            break;
        case 'yellow':
            $classes = 'bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300';
            break;
        case 'green':
            $classes = 'bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300';
            break;
        default:
            $classes = 'bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300';
            break;
    }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $text }}
</span>
