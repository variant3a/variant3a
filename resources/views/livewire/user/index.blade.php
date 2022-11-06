<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="flex flex-col p-2 mb-1 bg-white rounded shadow sm:mb-3 sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
            <div class="flex justify-center mb-3">
                <div class="w-1/2 h-0 pt-[50%] relative">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl">
                </div>
            </div>
            <div class="self-center mx-2">
                <div class="my-2 text-lg text-center break-all">
                    {{ $user->name }}
                </div>
                <div class="text-center break-all">
                    {{ $user->user_id }}
                </div>
            </div>
            <div class="self-center mx-2">
                <p class="text-center break-all text-neutral-400">
                    {{ $user->job }}
                </p>
                <p class="mb-4 text-center break-all text-neutral-400">
                    {{ $user->state }}
                </p>
            </div>
            @if ($user->bio)
                <hr>
                <p class="my-3 break-all text-neutral-400">
                    {!! nl2br(e($user->bio)) !!}
                </p>
            @endif
        </div>
        @if ($user->user_id === 'variant3a')
            <div class="flex justify-around p-2 mb-1 bg-white rounded shadow sm:mb-3 sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                <a href="https://github.com/variant3a" target="_blank no_refferer" class="w-4 h-auto text-center text-neutral-700 dark:text-neutral-200">
                    <i class="bi-github"></i>
                </a>
                <a href="https://github.com/variant3a/variant3a" target="_blank no_refferer" class="self-center">
                    <img src="{{ asset('images/logo_only_transparent_trim.png') }}" class="w-4 h-auto bg-transparent">
                </a>
                <a href="https://www.tumblr.com/variant3a" target="_blank no_refferer" class="w-4 h-auto text-center text-neutral-700 dark:text-neutral-200">
                    <i class="bi-images"></i>
                </a>
            </div>
        @endif
        <div class="flex flex-col p-2 pb-0 bg-white rounded shadow sm:p-3 sm:pb-1 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5"
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

                        <label class="block w-full p-2 font-bold text-center rounded shadow hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5"
                            x-show="!progress"
                            x-bind:class="droping ? 'bg-teal-400/90' : 'bg-teal-500'">

                            <input type="file" wire:model="files" class="hidden" accept="image/*" multiple>
                            Upload File
                        </label>
                        <div class="relative top-0 w-full h-10 font-bold text-center align-middle bg-gray-200 rounded dark:bg-gray-700 text-neutral-200"
                            x-show="progress">
                            <div class="h-10 transition-all ease-in-out bg-teal-600 rounded top-1 dark:bg-teal-500"
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
                                    <img src="{{ asset("storage/$photo->path") }}" class="absolute inset-0 object-cover w-full h-full rounded">
                                    <div class="absolute top-0 flex w-full h-full text-xl text-center rounded place-items-center justify-evenly start-0"
                                        x-bind:class="hover ? 'backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20' : ''"
                                        x-show="hover" x-cloak>
                                        <i class="block w-8 rounded cursor-pointer bi bi-arrows-angle-expand hover:bg-teal-500/50 hover:text-neutral-200" x-on:click="detail = !detail">
                                        </i>
                                        @if (auth()->id() === $photo->created_by)
                                            <i class="block w-8 text-red-500 rounded cursor-pointer bi bi-trash hover:bg-red-500/50 hover:text-neutral-200" wire:click="deletePicture({{ $photo->id }})">
                                            </i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="fixed top-0 left-0 z-50 w-full h-full bg-black/50"
                                x-show="detail"
                                x-on:click="detail = !detail" x-cloak>
                                <img src="{{ asset("storage/$photo->path") }}" class="absolute max-w-full max-h-full -translate-x-1/2 -translate-y-1/2 w-max h-max top-1/2 left-1/2">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mb-2 sm:mb-3 text-neutral-700 dark:text-neutral-200">
                    No Photos.
                </div>
            @endif
            @if ($photos->count() > 9)
                <button type="button" class="w-full p-2 mb-2 font-bold text-center bg-teal-500 rounded shadow sm:mb-4 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5 md:hidden"
                    x-on:click="expand = !expand"
                    x-text="expand ? 'Collapse' : 'Expand'" x-cloak x-transition>
                </button>
            @endif
        </div>
    </div>
    <div class="col-span-4 md:col-span-3">
        <div class="flex flex-col p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
            <div class="grid grid-cols-1 gap-1 my-2 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    Full Name
                </div>
                <div class="col-span-4 break-all md:col-span-3 text-neutral-700 dark:text-neutral-200">
                    {{ $user->name }}
                </div>
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-2 md:grid-cols-4 sm:gap-3">
                <div class="self-center col-span-4 md:col-span-1 text-neutral-400">
                    Email
                </div>
                @if ($hiddenEmail)
                    <div class="col-span-4 break-all md:col-span-3 text-neutral-700 dark:text-neutral-200">
                        {{ $hiddenEmail }}
                    </div>
                @else
                    <div class="col-span-4 break-all md:col-span-3 text-neutral-700 dark:text-neutral-200">
                        <button type="button" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5"
                            wire:click="getHiddenEmail()">
                            Show Email
                        </button>
                    </div>
                @endif
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-2 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    Languages
                </div>
                <div class="col-span-4 md:col-span-3 text-neutral-700 dark:text-neutral-200 break-word">
                    {{ $user->programming_lang }}
                </div>
            </div>
            <hr>
            <div class="grid grid-cols-1 gap-1 my-2 md:grid-cols-4 sm:gap-3">
                <div class="col-span-4 md:col-span-1 text-neutral-400">
                    Frameworks
                </div>
                <div class="col-span-4 md:col-span-3 text-neutral-700 dark:text-neutral-200 break-word">
                    {{ $user->frameworks }}
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            @if ($timelines->count())
                @foreach ($timelines as $timeline)
                    <div class="flex flex-col grid-cols-12 md:grid text-gray-50" wire:key="timeline-{{ $photo->id }}">
                        <div class="flex md:contents">
                            <div class="relative col-start-1 col-end-3 mx-2 md:mx-auto">
                                <div class="flex items-center justify-center w-8 h-full">
                                    <div class="w-1 h-full bg-white pointer-events-none dark:bg-zinc-700"></div>
                                </div>
                                <div class="absolute w-8 h-8 -mt-3 text-center bg-white rounded-full shadow top-1/2 dark:bg-zinc-700">
                                    <i class="bi text-xl leading-normal text-neutral-700 dark:text-neutral-200 {{ $timeline->icon ?? 'bi-circle' }}"></i>
                                </div>
                            </div>
                            <div class="w-full col-start-3 col-end-12 p-2 mt-3 bg-white rounded shadow md:mt-4 dark:bg-zinc-700 sm:p-3 h-fit ring-1 ring-black/5">
                                <h3 class="mb-1 text-lg font-semibold break-all text-neutral-700 dark:text-neutral-200">
                                    {{ $timeline->title }}
                                </h3>
                                <div class="mb-1 break-all text-neutral-700 dark:text-neutral-200">
                                    {!! e(App\Services\MarkdownService::parse($timeline->content)) !!}
                                </div>
                                <p class="w-full leading-tight text-justify break-word text-neutral-400">
                                    {{ $timeline->start_date->format('F, Y') }}
                                </p>
                                @if ($timeline->tags->count())
                                    <div class="flex flex-wrap">
                                        @foreach ($timeline->tags as $tag)
                                            <span class="inline mr-2 text-sm text-teal-500 break-all" wire:key="timeline-tag-{{ "$timeline->id-$tag->id" }}">
                                                <i class="bi bi-tag"></i>
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex flex-col grid-cols-12 mb-8 md:grid text-gray-50">
                    <div class="flex md:contents">
                        <div class="relative col-start-1 col-end-3 mx-2 md:mx-auto">
                            <div class="flex items-center justify-center w-8 h-full">
                                <div class="w-1 h-full bg-white pointer-events-none dark:bg-zinc-700"></div>
                            </div>
                            <div class="absolute w-8 h-8 -mt-3 text-center bg-white rounded-full shadow top-1/2 dark:bg-zinc-700">
                                <i class="text-xl leading-normal bi bi-code-slash text-neutral-700 dark:text-neutral-200"></i>
                            </div>
                        </div>
                        <div class="w-full col-start-3 col-end-12 p-2 py-12 my-3 md:my-4 sm:p-3 h-fit text-neutral-700 dark:text-neutral-200">
                            Keep Coding...
                        </div>
                    </div>
                </div>
            @else
                <div class="p-2 my-3 md:my-4 text-neutral-700 dark:text-neutral-200">
                    No Timelines.
                </div>
            @endif
        </div>
    </div>
</div>
