<div>
    <form wire:submit.prevent="update" method="POST">
        @csrf
        <div class="flex flex-col p-2 mb-1 bg-white rounded shadow sm:mb-3 sm:p-3 h-fit text-neutral-700 ring-1 ring-black/5">
            <div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1">
                    <div class="flex justify-center mb-2 sm:mb-3">
                        <div class="w-1/2 h-0 pt-[50%] relative">
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl" alt="profile photo">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center rounded-xl ring-1 ring-black/10">
                                    no photos
                                </div>
                            @endif
                        </div>
                    </div>
                    <div x-data="{ droping: false, progress: 0 }"
                        x-cloak>

                        <div x-on:drop.prevent="$wire.upload(
                                    'file',
                                    $event.dataTransfer.files,
                                    () => {droping = false;progress = 0},
                                    () => {droping = false;progress = 0},
                                    e => {progress = e.detail.progress}
                                )"
                            x-on:dragover.prevent="droping = true"
                            x-on:dragleave.prevent="droping = false"
                            x-on:livewire-upload-finish="droping = false;progress = 0"
                            x-on:livewire-upload-error="droping = false;progress = 0"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <label class="block w-full p-2 mb-2 font-bold text-center rounded shadow sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5"
                                x-show="!progress"
                                x-bind:class="droping ? 'bg-teal-400/90' : 'bg-teal-500'">

                                <input type="file" wire:model="file" class="hidden" accept="image/*">
                                upload file
                            </label>
                            <div class="relative top-0 w-full h-10 mb-2 font-bold text-center align-middle rounded bg-neutral-200 sm:mb-3 text-neutral-200"
                                x-show="progress">
                                <div class="h-10 transition-all ease-in-out bg-teal-600 rounded top-1"
                                    x-bind:style="{ width: `${progress}%` }">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="text" wire:model="user.json.job" class="mb-2 sm:mb-3 p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.json.job') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Job">
                        @error('user.json.job')
                            <div class="mb-1 text-sm text-red-600 sm:mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" wire:model="user.json.state" class="mb-2 sm:mb-3 p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.json.state') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="State">
                        @error('user.json.state')
                            <div class="mb-1 text-sm text-red-600 sm:mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea wire:model.debounce.500ms="user.json.bio" class="p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.json.bio') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Bio"
                            x-data="{ height: $el.scrollHeight }"
                            x-bind:style="{ 'height': height + 'px' }"
                            x-on:input="height = $el.scrollHeight"></textarea>
                        @error('user.json.bio')
                            <div class="text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-span-4 md:col-span-3">
                    <input type="text" wire:model="user.user_id" class="mb-2 sm:mb-3 p-2 w-full bg-neutral-200 rounded ring-1 ring-black/10 @error('user.user_id') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="User ID" disabled>
                    @error('user.user_id')
                        <div class="text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" wire:model="user.name" class="mb-2 sm:mb-3 p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.name') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Name">
                    @error('user.name')
                        <div class="text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" wire:model="user.json.programming_lang" class="mb-2 sm:mb-3 p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.json.programming_lang') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="JavaScript, PHP, HTML">
                    @error('user.json.programming_lang')
                        <div class="text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" wire:model="user.json.frameworks" class="mb-2 sm:mb-3 p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('user.json.frameworks') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Laravel, Livewire, AlpineJS">
                    @error('user.json.frameworks')
                        <div class="text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5">
                    save
                </button>
            </div>
        </div>
    </form>
    <div class="grid grid-cols-1 gap-0 md:grid-cols-3 md:gap-3">
        <div class="col-span-1 md:col-span-1 mb-1 sm:mb-3 overflow-auto max-h-[50vh]">
            @if ($timelines->count())
                @foreach ($timelines as $item)
                    <div class="flex flex-col grid-cols-12 md:grid text-neutral-50 md:contents" wire:key="timeline-{{ $item->id }}">
                        <div class="flex">
                            <div class="relative col-start-1 col-end-3 mx-1 md:mx-auto">
                                <div class="flex items-center justify-center w-8 h-full">
                                    <div class="h-full w-1 {{ 'bg-' . ($item->json['icon_color'] ?? 'white') }} pointer-events-none"></div>
                                </div>
                                <div class="w-8 h-8 absolute top-1/2 -mt-3 rounded-full {{ 'bg-' . ($item->json['icon_color'] ?? 'white') }} shadow text-center">
                                    <i class="text-xl leading-normal material-icons text-neutral-700">{{ $item->json['icon'] ?? 'bi-circle' }}</i>
                                </div>
                            </div>
                            <input type="radio" wire:model="selected_timeline" class="hidden peer" id="timeline-check-{{ $item->id }}" value="{{ $item->id }}" autocomplete="off">
                            <label for="timeline-check-{{ $item->id }}" wire:click="addTimeline({{ $item->id }})" class="w-full col-start-3 col-end-12 p-2 mx-1 mt-3 bg-white rounded shadow md:mt-4 sm:p-3 h-fit ring-1 ring-black/5 hover:bg-teal-500 hover:text-neutral-200 text-neutral-700 peer-checked:bg-teal-500 peer-checked:text-neutral-200">
                                <h3 class="mb-1 text-lg font-semibold break-all">
                                    {{ $item->title }}
                                </h3>
                                <p class="w-full leading-tight text-justify break-word">
                                    {{ $item->start_date->format('F, Y') }}
                                </p>
                            </label>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="m-3 text-neutral-400">
                    No Timelines.
                </div>
            @endif
            <div class="flex flex-col grid-cols-12 my-3 md:grid text-neutral-50">
                <div class="flex md:contents">
                    <button class="block w-full col-start-3 col-end-12 px-4 py-2 mx-1 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5" wire:click="clearTimeline()">
                        <i class="px-1 material-icons fs-4">add</i>
                        <span class="px-2">
                            add timeline
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-3 md:col-span-2">
            <div class="flex flex-col p-2 mb-1 bg-white rounded shadow sm:mb-3 sm:p-3 h-fit text-neutral-700 ring-1 ring-black/5"
                x-data="{ editorToggle: false }">
                <div class="flex flex-wrap justify-between"
                    x-data="{ showDropdown: false }">
                    <div class="flex flex-wrap">
                        <input type="month" wire:model.debounce.500ms="timeline.start_date" class="mb-2 sm:mb-3 p-2 w-fit bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.start_date') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror">
                        @error('timeline.start_date')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="p-2">
                            -
                        </div>
                        <input type="month" wire:model.debounce.500ms="timeline.end_date" class="mb-2 sm:mb-3 p-2 w-fit bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.end_date') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror">
                        @error('timeline.end_date')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if ($selected_timeline)
                        <div class="relative block">
                            <div class="fixed inset-0 w-screen h-screen" x-on:click="showDropdown = !showDropdown" x-show="showDropdown" x-on: x-cloak></div>
                            <button type="button" class="inline-block p-2 rounded hover:text-neutral-200 hover:bg-teal-500"
                                x-on:click="showDropdown = !showDropdown"
                                :class="showDropdown ? 'bg-teal-500 text-neutral-200' : 'text-teal-500'">
                                <i class="self-center px-1 text-xl material-icons">more_vert</i>
                            </button>
                            <div class="absolute right-0 z-30 w-56 py-1 mt-2 rounded shadow-lg sm:mt-3 backdrop-blur-lg bg-zinc-200/20 ring-1 ring-white/40 focus:outline-none" x-show="showDropdown" x-cloak x-transition>
                                <form wire:submit.prevent="deleteTimeline" method="POST">
                                    <button type="submit"class="w-full px-4 py-2 text-sm text-left text-red-500 hover:text-neutral-200 hover:bg-red-500/50">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex flex-wrap">
                    <div class="p-2 mb-2 sm:mb-3">
                        <i class="text-xl material-icons">{{ ($timeline->json['icon'] ?? 'bi-circle') . ' text-' . ($timeline->json['icon_color'] ?? '') }}</i>
                    </div>
                    <input type="text" wire:model.500ms="timeline.json.icon_color" class="mb-2 sm:mb-3 mr-2 sm:mr-3 p-2 w-fit bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.json.icon_color') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="color">
                    @error('timeline.json.icon_color')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" wire:model.500ms="timeline.json.icon" class="mb-2 sm:mb-3 p-2 w-fit bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.json.icon') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="bi-circle">
                    @error('timeline.json.icon')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex mb-2 sm:mb-3">
                    <input type="text" wire:model.500ms="timeline.title" class="p-2 w-full bg-white rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.title') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Title">
                    @error('timeline.title')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end mb-2 sm:mb-3">
                    <label class="flex align-middle cursor-pointer text-neutral-700">
                        Preview Mode
                        <div class="w-12 p-1 mx-2 rounded-full bg-neutral-100 ring-1 ring-black/5">
                            <input type="checkbox" x-model="editorToggle" class="hidden peer" autocomplete="off">
                            <div class="relative left-0 w-4 h-4 text-center text-teal-500 transition-all ease-in-out bg-white rounded-full shadow cursor-pointer hover:bg-teal-500 peer-checked:bg-teal-500 hover:text-neutral-200 peer-checked:text-neutral-200 peer-checked:left-6 ring-1 ring-black/5">
                            </div>
                        </div>
                    </label>
                </div>
                <div class="grow">
                    <div class="h-full" x-show="!editorToggle">
                        <textarea wire:model.debounce.500ms="timeline.content" class="p-2 w-full bg-white font-mono rounded ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0 @error('timeline.content') border-2 border-red-500 text-red-500 @else text-neutral-700 @enderror" placeholder="Content"
                            x-data="{ start: 0, height: $el.scrollHeight }"
                            x-on:keydown.tab.prevent="
                            start = $el.selectionStart
                            $el.value = $el.value.substr(0, $el.selectionEnd) + '    ' + $el.value.substr($el.selectionEnd);
                            $el.selectionStart = $el.selectionEnd = start + 4;
                        "
                            x-bind:style="{ 'height': height + 'px' }"
                            x-on:input="height = $el.scrollHeight"></textarea>
                        @error('timeline.content')
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-2 bg-white rounded markdown lh-lg text-wrap text-neutral-700 ring-1 ring-black/10" x-show="editorToggle" x-cloak>
                        @if ($timeline['content'] ?? false)
                            {!! e(Markdown::parse($timeline['content'])) !!}
                        @else
                            <span class="text-neutral-400">
                                no preview.
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-1 mb-1 md:grid-cols-3 sm:gap-3 sm:mb-3">
                <div class="col-span-3 md:col-span-1">
                    <div class="p-3 bg-white rounded shadow ring-1 ring-black/5">
                        <form wire:submit.prevent="createTag" method="post">
                            <input type="text" wire:model="new_tag" class="w-full p-2 mb-3 bg-white rounded text-neutral-700 ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0" placeholder="Tag name">
                            <button class="w-full p-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg text-neutral-200 ring-1 ring-black/5">
                                add tag
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-span-3 md:col-span-2">
                    <div class="p-3 pb-1 bg-white rounded shadow ring-1 ring-black/5">
                        <div class="flex mb-2 sm:mb-3">
                            <input type="text" wire:model="filter_tag" class="w-full p-2 mr-3 bg-white rounded text-neutral-700 ring-1 ring-black/10 focus:ring-2 focus:ring-teal-500 focus:outline-0" placeholder="Filter">
                            <button class="w-auto h-full px-3 py-2 bg-white rounded text-neutral-700 ring-1 ring-black/10 active:ring-2 active:ring-teal-500 focus:outline-0" wire:click="sortTag">
                                <i class="material-icons">sort</i>
                            </button>
                        </div>
                        <div class="flex flex-wrap">
                            @if ($tags->count())
                                @foreach ($tags as $tag)
                                    <span wire:key="tag-{{ $tag->id }}">
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
            </div>
        </div>
    </div>
</div>
