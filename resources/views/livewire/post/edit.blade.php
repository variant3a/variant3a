<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="p-3 mb-1 bg-white rounded shadow md:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
            <input type="text" wire:model="new_tag" class="w-full p-2 mb-3 bg-white rounded text-neutral-700 dark:text-neutral-200 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" placeholder="Tag name">
            <button class="w-full p-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                Add Tag
            </button>
        </div>
        <div class="p-3 pb-1 bg-white rounded shadow md:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
            <div class="flex mb-2 sm:mb-3">
                <input type="text" wire:model="filter_tag" class="w-full p-2 mr-3 bg-white rounded text-neutral-700 dark:text-neutral-200 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" placeholder="Filter">
                <button class="w-auto h-full px-3 py-2 bg-white rounded text-neutral-700 dark:text-neutral-200 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 active:ring-2 dark:active:ring-2 active:ring-teal-500 dark:active:ring-teal-500 focus:outline-0" wire:click="sortTag">
                    @if ($sort_tag)
                        <i class="bi bi-sort-alpha-up"></i>
                    @else
                        <i class="bi bi-sort-alpha-down"></i>
                    @endif
                </button>
            </div>
            <div class="flex flex-wrap">
                @if ($tags->count())
                    @foreach ($tags as $tag)
                        <span>
                            <input type="checkbox" wire:model="selected_tag" class="hidden peer" id="btn-check-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off">
                            <label class="block px-2 mb-2 mr-2 text-teal-500 break-all border-2 border-teal-500 rounded cursor-pointer hover:bg-teal-500 peer-checked:bg-teal-500 hover:text-neutral-200 peer-checked:text-neutral-200 ring-1 ring-black/5" for="btn-check-{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </span>
                    @endforeach
                @else
                    <div class="text-neutral-400">
                        no tags.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-4 md:col-span-3"
        x-data="{ editorToggle: false }">
        <form wire:submit.prevent="store" method="post">
            @csrf
            <div class="flex flex-col mb-3 p-3 pb-0 min-h-[calc(100vh_-_6.75rem)] shadow bg-white dark:bg-zinc-700 rounded ring-1 ring-black/5">
                <div class="mb-3">
                    <input type="text" wire:model.debounce.500ms="post.title" class="p-2 w-full bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.title') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Title">
                    @error('post.title')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end mb-3">
                    <label class="flex align-middle cursor-pointer text-neutral-700 dark:text-neutral-200">
                        Preview Mode
                        <div class="w-12 p-1 mx-2 rounded-full bg-neutral-100 dark:bg-zinc-600 ring-1 ring-black/5">
                            <input type="checkbox" x-model="editorToggle" class="hidden peer" autocomplete="off">
                            <div class="relative left-0 w-4 h-4 text-center text-teal-500 transition-all ease-in-out bg-white rounded-full shadow cursor-pointer dark:bg-zinc-500 hover:bg-teal-500 peer-checked:bg-teal-500 dark:text-neutral-200 hover:text-neutral-200 peer-checked:text-neutral-200 peer-checked:left-6 ring-1 ring-black/5">
                            </div>
                        </div>
                    </label>
                </div>
                <div class="mb-3 grow">
                    <div class="h-full" x-show="!editorToggle">
                        <textarea wire:model.debounce.500ms="post.content" class="p-2 w-full h-[calc(100vh_-_17.5rem)] font-mono bg-white dark:bg-zinc-600 rounded ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 @error('post.content') border-2 border-red-500 text-red-500 @else text-neutral-700 dark:text-neutral-200 @enderror" placeholder="Content"
                            x-data="{ start: 0 }"
                            x-on:keydown.tab.prevent="
                            start = $el.selectionStart
                            $el.value = $el.value.substr(0, $el.selectionEnd) + '    ' + $el.value.substr($el.selectionEnd);
                            $el.selectionStart = $el.selectionEnd = start + 4;
                        "></textarea>
                        @error('post.content')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-2 bg-white rounded markdown lh-lg text-wrap dark:bg-zinc-600 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/10 dark:ring-0" x-show="editorToggle" x-cloak>
                        @if ($post['content'] ?? false)
                            {!! e(App\Services\MarkdownService::parse($post['content'])) !!}
                        @else
                            <span class="text-neutral-400">
                                no preview.
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex mb-3 justify-content-between">
                    @if ($title === 'Edit Posts')
                        <span class="grow">
                            <button type="submit" class="px-4 py-2 font-bold text-center bg-red-500 rounded shadow hover:shadow-lg dark:hover:bg-red-400/90 text-neutral-200 ring-1 ring-black/5" form="delete">
                                Delete
                            </button>
                        </span>
                    @endif
                    <span class="flex-auto text-end">
                        <a href="{{ url($previous) }}" class="inline-block px-4 py-2 mr-3 font-bold text-center rounded shadow w-fit hover:shadow-lg bg-neutral-500 dark:hover:bg-neutral-400/90 text-neutral-200 ring-1 ring-black/5">
                            Cancel
                        </a>
                        <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                            Save
                        </button>
                    </span>
                </div>
            </div>
        </form>
        <form wire:submit.prevent="delete" id="delete" method="post"></form>
    </div>
</div>
