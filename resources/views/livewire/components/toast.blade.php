<div class="fixed bottom-0 right-0 z-20 flex items-end justify-end" data-turbo-permanent>
    <div class="flex flex-col-reverse">
        @if ($toasts)
            @foreach ($toasts as $toast)
                <div class="flex flex-col justify-between align-items-center m-2 md:m-3 p-2 min-w-[300px] shadow-lg rounded backdrop-blur-lg bg-zinc-200/20 ring-1 ring-white/40"
                    wire:key="toast-{{ $toast['id'] }}"
                    x-data="{ show: $wire.entangle('show.{{ $loop->index }}') }"
                    x-show="show"
                    x-init="setTimeout(() => { show = false }, 3000)"
                    x-cloak x-transition>
                    <div class="flex justify-between align-items-center">
                        <div class="text-lg font-bold break-all text-neutral-700">
                            {{ $toast['status'] }}
                        </div>
                        <button type="button" class="inline-block font-bold text-center rounded text-neutral-700 hover:ring-1 ring-white/40"
                            x-on:click="show=!show">
                            <i class="px-1 material-icons">close</i>
                        </button>
                    </div>
                    <div class="p-2 break-all text-neutral-700">
                        {{ $toast['message'] }}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
