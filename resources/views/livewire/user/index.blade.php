<div class="row">
    <div class="col-md-4 mb-3">
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
                <p class="text-muted mb-1">
                    Engineer
                </p>
                <p class="text-muted mb-4">
                    Sapporo, Japan
                </p>
                <div class="d-flex justify-content-center">
                    <a href="mailto:sulfur.monoxide168@gmail.com"class="btn btn-outline-main-500">
                        Send Email
                    </a>
                </div>
            </div>
        </div>
        <div class="card mb-3 text-bg-800">
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
    <div class="col-md-8 mb-3">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        Full Name
                    </div>
                    <div class="col text-muted">
                        Yuma Nishimura
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        Email
                    </div>
                    <div class="col text-muted">
                        {{ $user->email }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        Languages
                    </div>
                    <div class="col text-muted">
                        PHP, JavaScript, HTML, CSS, Kotlin
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        Frameworks
                    </div>
                    <div class="col text-muted">
                        Laravel, WordPress, Vue, Inertia, Livewire, Alpine, Bootstrap
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card text-bg-800">
            <div class="card-body">
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
                <div class="row mb-3">
                    <div class="col-12">
                        <span class="ms-1 text-muted">
                            Photos
                        </span>
                    </div>
                </div>
                <div class="row">
                    @if ($photos->count())
                        @foreach ($photos as $photo)
                            <div class="col-md-4 mb-3 d-flex justify-content-center align-items-center"
                                x-data="{ hover: false }">
                                <div class="position-relative"
                                    x-on:mouseover="hover = true"
                                    x-on:mouseleave="hover = false">

                                    <img src="{{ asset("storage/$photo->path") }}" class="w-100">
                                    <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-center w-100 h-100"
                                        x-bind:class="hover ? 'glass-black' : ''">

                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="btn btn-outline-white me-1" x-show="hover" x-cloak>
                                                Detail
                                            </button>
                                            @if ($user->id === auth()->id())
                                                <button class="btn btn-outline-red-600" x-show="hover" x-cloak>
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            No Photos.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
