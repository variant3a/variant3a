<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card mb-3 text-bg-800">
                    <div class="card-body text-center">
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="w-50 position-relative" style="height:0;padding-top:50%">
                                <img src="{{ asset("storage/$user->profile_photo_path") }}" class="w-100 h-100 fixed-top position-absolute rounded-4" style="object-fit:cover;z-index:auto">
                            </div>
                        </div>
                        <h5 class="my-3">
                            {{ $user->user_id }}
                        </h5>
                        <p class="text-400 mb-1">
                            Engineer
                        </p>
                        <p class="text-400 mb-4">
                            Sapporo, Japan
                        </p>
                        <div class="d-flex justify-content-center">
                            <a href="mailto:sulfur.monoxide168@gmail.com"class="btn btn-outline-main-500">
                                Send Email
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card text-bg-800">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-evenly">
                            <a href="https://github.com/variant3a" target="_blank no_refferer" class="text-white">
                                <i class="bi-github"></i>
                            </a>
                            <a href="https://github.com/variant3a/variant3a" target="_blank no_refferer" class="text-white">
                                <img src="{{ asset('images/favicon-512.gif') }}" class="bg-transparent" style="width:1rem;height:auto">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3 d-none d-md-block">
                <div class="card text-bg-800">
                    <div class="card-body pb-3">
                        @if ($user->id === auth()->id())
                            <div class="row mb-3"
                                x-data="{ droping: false, progress: 0 }"
                                x-cloak>

                                <div class="col-12 d-grid gap-2"
                                    x-on:drop.prevent="$wire.uploadMultiple(
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

                                    <label class="btn btn-outline-main-500 px-3 py-2 d-hidden"
                                        x-show="!progress"
                                        x-bind:style="{ 'border-style': droping ? 'dashed' : 'solid' }">

                                        <input type="file" wire:model="files" class="d-none" accept="image/*" multiple>
                                        Upload File
                                    </label>
                                    <div x-show="progress">
                                        <div class="progress border border-1 border-main-500 text-main-500 bg-transparent fs-6" style="height:unset">
                                            <div class="progress-bar px-3 py-2 progress-bar-striped progress-bar-animated bg-main-500"
                                                x-bind:style="{ width: `${progress}%` }">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row px-2">
                            @if ($photos->count())
                                @foreach ($photos as $photo)
                                    <div class="col-4 col-md-6 col-xl-4 p-1"
                                        x-data="{ hover: false, detail: false }">
                                        <div class="position-relative">
                                            <div class="w-100 position-relative" style="height:0;padding-top:100%"
                                                x-on:mouseover="hover = true"
                                                x-on:mouseleave="hover = false">
                                                <img src="{{ asset("storage/$photo->path") }}" class="w-100 h-100 fixed-top position-absolute rounded" style="object-fit:cover;z-index:auto">
                                                <div class="w-auto h-auto position-absolute top-50 start-50 translate-middle"
                                                    x-show="hover" x-cloak>
                                                    <i class="bi bi-arrows-angle-expand fs-4" style="cursor:pointer"
                                                        x-on:click="detail = !detail">
                                                    </i>
                                                    @if (auth()->id() === $photo->created_by)
                                                        <i class="bi bi-trash fs-4 text-red-500" style="cursor:pointer"
                                                            wire:click="deletePicture({{ $photo->id }})">
                                                        </i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-fixed w-100 vh-100 top-0 start-0" style="background-color: #00000070;z-index:8000"
                                            x-show="detail"
                                            x-on:click="detail = !detail" x-cloak>
                                            <img src="{{ asset("storage/$photo->path") }}" class="w-auto h-auto position-absolute top-50 start-50 translate-middle" style="max-width:98%;max-height:98%">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-muted">
                                    No Photos.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card text-bg-800">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 text-nowrap">
                                        Full Name
                                    </div>
                                    <div class="col-md-9 col-12 text-400">
                                        Yuma Nishimura
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 text-nowrap">
                                        Email
                                    </div>
                                    <div class="col-md-9 col-12 text-400">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 text-nowrap">
                                        Languages
                                    </div>
                                    <div class="col-md-9 col-12 text-400">
                                        PHP, JavaScript, HTML, CSS, Kotlin
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 text-nowrap">
                                        Frameworks
                                    </div>
                                    <div class="col-md-9 col-12 text-400">
                                        Laravel, WordPress, Vue, Inertia, Livewire, Alpine, Bootstrap
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <span class="ms-1 text-400">
                                    Timelines
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if ($timelines->count())
                                    @foreach ($timelines as $timeline)
                                        <div class="timeline-item">
                                            <div class="py-2 d-flex align-items-center">
                                                <i class="px-1 fs-4 bi {{ ($timeline->icon ?? 'bi-circle') . ' text-' . ($timeline->icon_color ?? '') }}"></i>
                                                <span class="px-2 text-muted">
                                                    {{ $timeline->start_date->format('F, Y') }}
                                                </span>
                                            </div>
                                            <div class="d-flex">
                                                <div class="mx-3 border-1 border-start {{ 'border-' . ($timeline->icon_color ?? '') }}"></div>
                                                <div class="ms-2 my-3">
                                                    <div class="card text-bg-800">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h5 class="mb-3">
                                                                        {{ $timeline->title }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="px-4 col-12 markdown overflow-hidden lh-lg">
                                                                    {!! e(App\Services\MarkdownService::parse($timeline->content)) !!}
                                                                </div>
                                                            </div>
                                                            @if ($timeline->tags->count())
                                                                <div class="row mt-3">
                                                                    <div class="col-12">
                                                                        @foreach ($timeline->tags as $tag)
                                                                            <span class="mb-1 me-1 py-1 px-3 border border-main-500 small text-main-500 rounded-1">
                                                                                {{ $tag->name }}
                                                                            </span>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="timeline-item">
                                        <div class="py-2 d-flex align-items-center">
                                            <i class="px-1 fs-4 text-muted bi bi-code-slash"></i>
                                            <span class="px-2 text-muted">
                                                Continuing...
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-3 col-12 text-muted">
                                        No Timelines.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3  d-md-none">
                <div class="card text-bg-800">
                    <div class="card-body pb-3">
                        @if ($user->id === auth()->id())
                            <div class="row mb-3"
                                x-data="{ droping: false, progress: 0 }"
                                x-cloak>

                                <div class="col-12 d-grid gap-2"
                                    x-on:drop.prevent="$wire.uploadMultiple(
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

                                    <label class="btn btn-outline-main-500 px-3 py-2 d-hidden"
                                        x-show="!progress"
                                        x-bind:style="{ 'border-style': droping ? 'dashed' : 'solid' }">

                                        <input type="file" wire:model="files" class="d-none" accept="image/*" multiple>
                                        Upload File
                                    </label>
                                    <div x-show="progress">
                                        <div class="progress border border-1 border-main-500 text-main-500 bg-transparent fs-6" style="height:unset">
                                            <div class="progress-bar px-3 py-2 progress-bar-striped progress-bar-animated bg-main-500"
                                                x-bind:style="{ width: `${progress}%` }">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row px-2">
                            @if ($photos->count())
                                @foreach ($photos as $photo)
                                    <div class="col-4 col-md-6 col-xl-4 p-1"
                                        x-data="{ hover: false, detail: false }">
                                        <div class="position-relative">
                                            <div class="w-100 position-relative" style="height:0;padding-top:100%"
                                                x-on:mouseover="hover = true"
                                                x-on:mouseleave="hover = false">
                                                <img src="{{ asset("storage/$photo->path") }}" class="w-100 h-100 fixed-top position-absolute rounded" style="object-fit:cover;z-index:auto">
                                                <div class="w-auto h-auto position-absolute top-50 start-50 translate-middle"
                                                    x-show="hover" x-cloak>
                                                    <i class="bi bi-arrows-angle-expand fs-4" style="cursor:pointer"
                                                        x-on:click="detail = !detail">
                                                    </i>
                                                    @if (auth()->id() === $photo->created_by)
                                                        <i class="bi bi-trash fs-4 text-red-500" style="cursor:pointer"
                                                            wire:click="deletePicture({{ $photo->id }})">
                                                        </i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-fixed w-100 vh-100 top-0 start-0" style="background-color: #00000070;z-index:8000"
                                            x-show="detail"
                                            x-on:click="detail = !detail" x-cloak>
                                            <img src="{{ asset("storage/$photo->path") }}" class="w-auto h-auto position-absolute top-50 start-50 translate-middle" style="max-width:98%;max-height:98%">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-muted">
                                    No Photos.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
