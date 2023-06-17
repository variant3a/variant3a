<label {{ $attributes->merge(['class' => 'block px-2 py-1 mb-2 mr-2 text-teal-100/80 break-all border border-teal-100/80 rounded-lg cursor-pointer active:ring-2 active:ring-black/20 peer-checked:bg-teal-800 peer-checked:border-teal-800']) }}>
    {{ $slot }}
</label>
