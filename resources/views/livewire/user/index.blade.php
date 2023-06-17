<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="flex flex-col p-2 mb-1 bg-neutral-800 rounded-3xl sm:mb-3 sm:p-3 h-fit text-neutral-400">
            <div class="flex justify-center mb-3">
                <div class="w-1/2 h-0 pt-[50%] relative">
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-3xl" alt="profile photo">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center rounded-xl">
                            no photos
                        </div>
                    @endif
                </div>
            </div>
            <div class="self-center mx-2">
                <div class="my-2 text-lg text-center break-all">
                    {{ $user->name }}
                </div>
                <div class="text-center break-all">
                    {{ '@' . $user->user_id }}
                </div>
            </div>
            <div class="self-center mx-2">
                <p class="text-center break-all text-neutral-400">
                    {{ $user->json['job'] }}
                </p>
                <p class="mb-4 text-center break-all text-neutral-400">
                    {{ $user->json['state'] }}
                </p>
            </div>
            @if ($user->json['bio'])
                <hr>
                <p class="my-3 break-all text-neutral-400">
                    {!! nl2br(e($user->json['bio'])) !!}
                </p>
            @endif
        </div>
        <div class="flex flex-col p-2 pb-0 bg-neutral-800 rounded-3xl sm:p-3 sm:pb-1 h-fit text-neutral-400"
            x-data="{ expand: false }">
            @if ($user->id === auth()->id())
                <div class="mb-2 sm:mb-3"
                    x-data="{ droping: false, progress: 0 }"
                    x-cloak>

                    <div x-on:drop.prevent="$wire.uploadMultiple(
                                    'files',
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

                        <label class="block w-full p-2 text-center text-teal-400 cursor-pointer hover:bg-teal-600/20 active:bg-teal-600/30 rounded-3xl hover:bg-teal-300"
                            x-show="!progress"
                            x-bind:class="droping ? 'bg-teal-400/90' : ''">

                            <input type="file" wire:model="files" class="hidden" accept="image/*" multiple>
                            upload file
                        </label>
                        <div class="relative top-0 w-full h-10 font-bold text-center align-middle rounded-3xl bg-neutral-700 text-neutral-200"
                            x-show="progress">
                            <div class="h-10 transition-all ease-in-out bg-teal-600 rounded-3xl top-1"
                                x-bind:style="{ width: `${progress}%` }">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($photos->count())
                <div class="grid grid-cols-3 grid-rows-3 overflow-hidden md:grid-rows-auto md:auto-rows-auto md:grid-cols-2 gap-x-2 gap-y-0 sm:gap-x-3"
                    x-bind:class="expand ? '' : 'auto-rows-[0]'">
                    @foreach ($photos as $photo)
                        <div x-data="{ hover: false, detail: false }" wire:key="photo-{{ $photo->id }}">
                            <div class="flex justify-center mb-2 sm:mb-3">
                                <div class="w-full h-0 pt-[100%] relative"
                                    x-on:mouseover="hover = true"
                                    x-on:mouseleave="hover = false">
                                    <img src="{{ asset('storage/webp/' . pathinfo($photo->path, PATHINFO_DIRNAME) . '/' . pathinfo($photo->path, PATHINFO_FILENAME) . '.webp') }}" class="absolute inset-0 object-cover w-full h-full rounded">
                                    <div class="absolute top-0 flex w-full h-full text-xl text-center rounded place-items-center justify-evenly start-0"
                                        x-bind:class="hover ? 'backdrop-blur-lg bg-zinc-200/20' : ''"
                                        x-show="hover" x-cloak>
                                        <i class="block w-8 rounded cursor-pointer material-icons hover:bg-teal-500/50 hover:text-neutral-200" x-on:click="detail = !detail">fullscreen</i>
                                        @if (auth()->id() === $photo->created_by)
                                            <i class="block w-8 text-red-500 rounded cursor-pointer material-icons bi bi-trash hover:bg-red-500/50 hover:text-neutral-200" wire:click="deletePicture({{ $photo->id }})">delete</i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="fixed top-0 left-0 z-50 w-full h-full bg-black/50"
                                x-show="detail"
                                x-on:click="detail = !detail" x-cloak>
                                <img src="{{ asset("storage/$photo->path") }}" loading="lazy" class="absolute max-w-full max-h-full -translate-x-1/2 -translate-y-1/2 w-max h-max top-1/2 left-1/2">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mb-2 sm:mb-3 text-neutral-400">
                    no photos.
                </div>
            @endif
            @if ($photos->count() > 9)
                <button type="button" class="w-full p-2 mb-2 text-teal-300 bg-teal-800 hover:bg-teal-700 disabled:bg-neutral-700 disabled:text-neutral-400 sm:mb-4 md:hidden rounded-3xl"
                    x-on:click="expand = !expand"
                    x-text="expand ? 'collapse' : 'expand'" x-cloak x-transition>
                </button>
            @endif
        </div>
    </div>
    <div class="col-span-4 md:col-span-3">
        <div class="flex flex-col p-2 bg-neutral-800 rounded-3xl sm:p-3 h-fit text-neutral-400">
            <div class="grid grid-cols-1 gap-1 my-3 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    full name
                </div>
                <div class="col-span-4 break-all md:col-span-3 text-neutral-400">
                    {{ $user->name }}
                </div>
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-3 md:grid-cols-4 sm:gap-3">
                <div class="self-center col-span-4 md:col-span-1 text-neutral-400">
                    email
                </div>
                @if ($hiddenEmail)
                    <div class="col-span-4 break-all md:col-span-3 text-neutral-400">
                        {{ $hiddenEmail }}
                    </div>
                @else
                    <div class="col-span-4 break-all md:col-span-3 text-neutral-400">
                        <button type="button" class="inline text-teal-500 hover:underline"
                            wire:click="getHiddenEmail()">
                            show email
                        </button>
                    </div>
                @endif
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-3 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    languages
                </div>
                <div class="col-span-4 md:col-span-3 text-neutral-400 break-word">
                    {{ $user->json['programming_lang'] }}
                </div>
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-3 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    frameworks
                </div>
                <div class="col-span-4 md:col-span-3 text-neutral-400 break-word">
                    {{ $user->json['frameworks'] }}
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            @if ($timelines->count())
                <div class="flex flex-col grid-cols-12 mt-8 md:grid text-neutral-50">
                    <div class="flex md:contents">
                        <div class="relative col-start-1 col-end-3 mx-2 md:mx-auto">
                            <div class="flex items-center justify-center w-8 h-full">
                                <div class="w-1 h-full bg-teal-700 pointer-events-none"></div>
                            </div>
                            <div class="absolute w-8 h-8 -mt-3 text-center bg-teal-500 rounded-3xl top-1/2">
                                <i class="text-xl leading-normal material-icons text-neutral-700">data_object</i>
                            </div>
                        </div>
                        <div class="w-full col-start-3 col-end-12 p-2 py-12 my-3 md:my-4 sm:p-3 h-fit text-neutral-400">
                            keep coding...
                        </div>
                    </div>
                </div>
                @foreach ($timelines as $timeline)
                    <div class="flex flex-col grid-cols-12 md:grid text-neutral-50" wire:key="timeline-{{ $timeline->id }}">
                        <div class="flex md:contents">
                            <div class="relative col-start-1 col-end-3 mx-2 md:mx-auto">
                                <div class="flex items-center justify-center w-8 h-full">
                                    <div class="w-1 h-full bg-teal-700 pointer-events-none"></div>
                                </div>
                                <div class="absolute w-8 h-8 -mt-3 text-center @if (!$timeline->end_date || $timeline->end_date->gt(now())) bg-teal-500 @else bg-neutral-700 @endif rounded-3xl top-1/2">
                                    <i class="text-xl leading-normal material-icons text-neutral-700">{{ $timeline->json['icon'] ?? '' }}</i>
                                </div>
                            </div>
                            <div class="w-full col-start-3 col-end-12 p-2 mt-3 bg-neutral-800 rounded-2xl md:mt-4 sm:p-3 h-fit">
                                <h3 class="mb-1 text-lg font-semibold break-all text-neutral-400">
                                    {{ $timeline->title }}
                                </h3>
                                <div class="mb-2 break-all markdown text-neutral-400">
                                    {!! e(Markdown::parse($timeline->content)) !!}
                                </div>
                                @if ($timeline->tags->count())
                                    <div class="flex flex-wrap mb-2">
                                        @foreach ($timeline->tags as $tag)
                                            <div class="flex items-center mr-2 space-x-1 text-sm text-teal-500 break-all" wire:key="timeline-tag-{{ "$timeline->id-$tag->id" }}">
                                                <i class="material-icons">tag</i>
                                                {{ $tag->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <span class="flex items-center space-x-1 text-neutral-400" title="{{ $timeline->start_date->format('Y-m-d H:i:s') }}">
                                    <i class="material-icons">calendar_today</i>
                                    <span>
                                        {{ $timeline->start_date->format('F, Y') }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-2 my-3 md:my-4 text-neutral-400">
                    no timelines.
                </div>
            @endif
        </div>
    </div>
</div>
