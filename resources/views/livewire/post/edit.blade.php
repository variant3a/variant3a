<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="p-3 mb-1 bg-white rounded shadow md:mb-3 ring-1 ring-black/5">
            <form wire:submit.prevent="createTag" method="post">
                <input type="text" wire:model="new_tag" class="w-full p-2 mb-3 bg-white rounded text-neutral-700 ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0" placeholder="tag name">
                <button class="w-full p-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5">
                    add tag
                </button>
            </form>
        </div>
        <div class="p-3 pb-1 bg-white rounded shadow md:mb-3 ring-1 ring-black/5">
            <div class="flex mb-2 sm:mb-3">
                <input type="text" wire:model="filter_tag" class="w-full p-2 mr-3 bg-white rounded text-neutral-700 ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0" placeholder="filter">
                <button class="w-auto h-full px-3 py-2 bg-white rounded text-neutral-700 ring-1 ring-black/10 active:ring-2 active:ring-teal-500 focus:outline-0" wire:click="sortTag">
                    <i class="material-icons">sort</i>
                </button>
            </div>
            <div class="flex flex-wrap">
                @if ($tags->count())
                    @foreach ($tags as $tag)
                        <span wire:key="tag-{{ "$tag->id" }}">
                            <input type="checkbox" wire:model="selected_tag" class="hidden peer" id="btn-check-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off">
                            <label class="block px-2 mb-2 mr-2 text-teal-500 break-all border-2 border-teal-500 rounded cursor-pointer active:ring-2 active:ring-black/20 peer-checked:bg-teal-500 peer-checked:text-neutral-200" for="btn-check-{{ $tag->id }}">
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
        x-data="{ editorToggle: false, draft: $persist($wire.entangle('post_data')).as('postData' + ($wire.post_data?.id ?? 0)) }">
        <form wire:submit.prevent="store" method="post">
            @csrf
            <div class="flex flex-col mb-3 p-3 pb-0 min-h-[calc(100vh_-_6.75rem)] shadow bg-white rounded ring-1 ring-black/5">
                <div class="mb-3">
                    <input type="text" wire:model.debounce.500ms="post_data.title" class="p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('post_data.title') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="title">
                    @error('post_data.title')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" wire:model.debounce.500ms="post_data.json.description" class="p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('post_data.json.description') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="description">
                    @error('post_data.json.description')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end mb-3">
                    <label class="flex align-middle cursor-pointer text-neutral-700">
                        preview mode
                        <div class="w-12 p-1 mx-2 rounded-full bg-neutral-100 ring-1 ring-black/5">
                            <input type="checkbox" x-model="editorToggle" class="hidden peer" autocomplete="off">
                            <div class="relative left-0 w-4 h-4 text-center text-teal-500 transition-all ease-in-out bg-white rounded-full shadow cursor-pointer hover:bg-teal-500 peer-checked:bg-teal-500 hover:text-neutral-200 peer-checked:text-neutral-200 peer-checked:left-6 ring-1 ring-black/5">
                            </div>
                        </div>
                    </label>
                </div>
                <div class="mb-3 grow">
                    <div class="h-full" x-data="{ start: 0, droping: false, progress: 0 }"
                        x-show="!editorToggle">
                        <textarea wire:model.debounce.500ms="post_data.content" class="p-2 w-full h-[calc(100vh_-_17.5rem)] font-mono bg-white rounded focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('post_data.content') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="content"
                            x-on:keydown.tab.prevent="
                            start = $el.selectionStart
                            $el.value = $el.value.substr(0, $el.selectionEnd) + '    ' + $el.value.substr($el.selectionEnd);
                            $el.selectionStart = $el.selectionEnd = start + 4;
                        "
                            x-bind:class="droping ? 'ring-2 ring-teal-500' : 'ring-1 ring-black/10'"
                            x-on:drop.prevent="$wire.upload(
                                'file',
                                $event.dataTransfer.files[0],
                                () => {
                                    droping = false;
                                    progress = 0;
                                    start = $el.selectionStart;
                                    $el.value = $el.value.substr(0, $el.selectionEnd) + `![${$wire.file_path}](${$wire.file_path})` + $el.value.substr($el.selectionEnd);
                                    $el.selectionStart = $el.selectionEnd = start + $wire.file_path.length;
                                },
                                ()=> {droping = false;progress = 0},
                                e => {progress = e.detail.progress}
                            )"
                            x-on:dragover.prevent="droping = true"
                            x-on:dragleave.prevent="droping = false"
                            x-on:livewire-upload-finish="droping = false;progress = 0"
                            x-on:livewire-upload-error="droping = false;progress = 0"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"></textarea>
                        <input type="file" wire:model="file" class="hidden" accept="image/*" multiple>
                        @error('post_data.content')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-2 bg-white rounded markdown lh-lg text-wrap text-neutral-700 ring-1 ring-black/10" x-show="editorToggle" x-cloak>
                        @if ($post_data['content'] ?? false)
                            {!! e(Markdown::parse($post_data['content'])) !!}
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
                            <button type="submit" class="px-4 py-2 font-bold text-center bg-red-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5" form="delete">
                                delete
                            </button>
                        </span>
                    @endif
                    <span class="flex-auto text-end">
                        <a href="{{ url($previous) }}" class="inline-block px-4 py-2 mr-3 font-bold text-center rounded shadow w-fit hover:shadow-lg bg-neutral-500 text-neutral-200 ring-1 ring-black/5">
                            cancel
                        </a>
                        <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5">
                            save
                        </button>
                    </span>
                </div>
            </div>
        </form>
        <form wire:submit.prevent="delete" id="delete" method="post"></form>
    </div>
</div>
