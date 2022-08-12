<div class="row">
    <div class="col-12">
        <div class="row mb-3"
            x-data="{ droping: false, progress: 0 }"
            x-cloak>

            <div class="col-md-10 offset-md-1 col-12 d-grid gap-2"
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
        <div class="row">
            @if ($photos->count())
                @foreach ($photos as $photo)
                    <div class="col-md-4 mb-3 d-flex justify-content-center align-items-center">
                        <img src="{{ asset("storage/$photo->path") }}" class="w-100">
                    </div>
                @endforeach
            @else
                No Photos.
            @endif
        </div>
    </div>
</div>
