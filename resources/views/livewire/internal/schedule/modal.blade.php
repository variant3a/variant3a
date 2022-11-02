<form wire:submit.prevent="saveEvent" method="post">
    <div id="add-event-modal" class="fixed top-0 left-0 z-30"
        x-data="{
            mouse: { x: 0, y: 0 },
            isAllday: true,
            modalStyle: @entangle('modal_window'),
            isCollapsed: false,
        }"
        :class="modalStyle.show ? 'block' : 'hidden'" x-cloak x-transition>
        <div class="relative flex flex-col md:mb-3 p-1 sm:p-3 min-w-[30vw] w-screen h-screen md:w-auto md:h-auto shadow-2xl drop-shadow-2xl bg-white dark:bg-zinc-700 rounded ring-1 ring-black/5"
            x-ref="modalEl"
            x-bind:style="modalStyle">
            <div class="flex justify-between mb-1 sm:mb-3" draggable="true"
                x-on:dragstart="
                mouse.x = $refs.modalEl.offsetLeft - event.pageX;
                mouse.y = $refs.modalEl.offsetTop - event.pageY;
                event.dataTransfer.setDragImage(document.createElement('div'), 0, 0);
            "
                x-on:drag="
                if (!event.x && !event.y) return;
                $refs.modalEl.style.setProperty('left', event.pageX + mouse.x + 'px');
                $refs.modalEl.style.setProperty('top', event.pageY + mouse.y + 'px');
            "
                x-on:dragend="
            $wire.set('modal_window.left', event.pageX + mouse.x + 'px');
            $wire.set('modal_window.top', event.pageY + mouse.y + 'px');
            mouse.x = mouse.y = 0;">
                <span class="p-2 align-middle text-neutral-700 dark:text-neutral-200">
                    {{ $modal_window['title'] }} Event
                </span>
                <span>
                    <button type="button" class="hidden p-2 mr-1 font-bold text-center rounded md:inline-block text-neutral-700 dark:text-neutral-200 hover:ring-1 ring-white/40 dark:ring-white/20" x-on:click="isCollapsed = !isCollapsed">
                        <i class="px-1 bi bi-dash"></i>
                    </button>
                    <button type="button" class="inline-block p-2 font-bold text-center rounded text-neutral-700 dark:text-neutral-200 hover:ring-1 ring-white/40 dark:ring-white/20" wire:click="closeModal">
                        <i class="px-1 bi bi-x"></i>
                    </button>
                </span>
            </div>
            <input type="text" wire:model.lazy="event.title" class="mb-1 sm:mb-3 p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.title') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
            @error('event.title')
                <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <label class="flex justify-end mb-1 align-middle cursor-pointer sm:mb-3 text-neutral-700 dark:text-neutral-200" for="check-allday">
                Preview Mode
                <div class="w-12 p-1 mx-2 rounded-full ring-1 bg-neutral-100 dark:bg-zinc-600 ring-black/5">
                    <input type="checkbox" wire:model="event.all_day" class="hidden peer" autocomplete="off" id="check-allday">
                    <div class="relative left-0 w-4 h-4 text-center text-teal-500 transition-all ease-in-out bg-white rounded-full shadow cursor-pointer dark:bg-zinc-500 peer-checked:bg-teal-500 dark:text-neutral-200 peer-checked:text-neutral-200 peer-checked:left-6 ring-1 ring-black/5">
                    </div>
                </div>
            </label>
            <div class="grid grid-cols-1 gap-1 mb-1 md:grid-cols-2 sm:gap-3 sm:mb-3">
                <div class="col-span-2 md:col-span-1">
                    <input type="date" wire:model.lazy="event.start" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.start') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
                    @error('event.start')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-span-2 md:col-span-1">
                    <input type="date" wire:model.lazy="event.end" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.end') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
                    @error('event.end')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-span-2 md:col-span-1" x-show="!$wire.event.all_day">
                    <input type="time" wire:model.lazy="event.start_time" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.start_time') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
                    @error('event.start_time')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-span-2 md:col-span-1" x-show="!$wire.event.all_day">
                    <input type="time" wire:model.lazy="event.end_time" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.end_time') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
                    @error('event.end_time')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <input type="text" wire:model.lazy="event.location" class="mb-1 sm:mb-3 p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.location') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Tokyo, Japan">
            @error('event.location')
                <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <input type="text" wire:model.lazy="event.url" class="mb-1 sm:mb-3 p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.url') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="www.google.com">
            @error('event.url')
                <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <textarea wire:model.debounce.500ms="event.description" class="mb-1 sm:mb-3 p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('event.description') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Content"></textarea>
            @error('event.description')
                <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <div class="flex justify-between">
                @if ($modal_window['title'] === 'Edit')
                    <button type="button" class="inline-block px-4 py-2 font-bold text-center bg-red-500 rounded shadow w-fit hover:shadow-lg dark:hover:bg-red-400/90 text-neutral-200 ring-1 ring-black/5" wire:click="deleteEvent()">
                        Delete
                    </button>
                @endif
                <div class="flex-auto text-end">
                    <button type="button" class="inline-block px-4 py-2 font-bold text-center rounded shadow sm:mr-2 w-fit hover:shadow-lg bg-neutral-500 dark:hover:bg-neutral-400/90 text-neutral-200 ring-1 ring-black/5" wire:click="closeModal">
                        Cancel
                    </button>
                    <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
