<button {{ $attributes->class([
    'text-teal-900 bg-teal-400 hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400' => ($style ?? '') === 'filled',
    'text-teal-300 bg-teal-800 hover:bg-teal-700 disabled:bg-neutral-700 disabled:text-neutral-400' => ($style ?? '') === 'filled-tonal',
    'text-teal-400 border border-teal-100/80 hover:bg-teal-600/20 disabled:hover:bg-transparent disabled:border-neutral-400 disabled:text-neutral-400' => ($style ?? '') === 'outlined',
    'text-teal-400 hover:bg-teal-600/20 disabled:hover:bg-transparent disabled:text-neutral-400 active:bg-teal-600/30' => !isset($style),
    'rounded-3xl',
]) }}>
    {{ $slot }}
</button>
