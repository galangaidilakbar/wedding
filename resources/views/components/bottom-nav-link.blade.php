@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex flex-col items-center justify-center px-5 bg-gray-50 dark:bg-gray-800 group'
                : 'inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group';

    $bottom_nav_icon_classes = ($active ?? false)
                ? 'text-blue-600 dark:text-blue-500'
                : 'text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500';

    $bottom_nav_text_classes = ($active ?? false)
                ? 'text-sm text-blue-600 text-blue-500'
                : 'text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div {{ $attributes->merge(['class' => $bottom_nav_icon_classes]) }}>
        {{ $bottom_nav_icon }}
    </div>

    <span {{ $attributes->merge(['class' => $bottom_nav_text_classes]) }}>
        {{ $bottom_nav_text }}
    </span>
</a>
