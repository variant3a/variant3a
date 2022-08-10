<div class="row">
    <div class="upload-container"
        x-data="{ droping: false, progress: 0 }" x-cloak>

        <div class="position-absolute top-0 start-0 vw-100 vh-100"
            x-on:drop.prevent="$wire.uploadMultiple(
                'files',
                $event.dataTransfer.files,
                () => {droping = false;progress = 0},
                () => {droping = false;progress = 0},
                e => {progress = e.detail.progress}
            )"
            x-on:dragover.prevent="droping = true"
            x-on:dragleave.prevent="droping = false">

            <div class="position-absolute top-50 start-50 translate-middle">
                <div class="text-center" x-show="droping && !progress">
                    Drop Here
                </div>
                <div x-show="progress !== 0">
                    <div class="text-center mb-3">
                        Uploading...
                    </div>
                    <div class="progress" style="width: 70vw">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-main-500" x-bind:style="{ width: `${progress}%` }">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="flex justify-content-center align-items-center" wire:loading.remove>
            @if ($photos->count())
                @foreach ($photos as $photo)
                    <img src="{{ asset("storage/$photo->path") }}">
                @endforeach
            @else
                No Photos.
            @endif
        </div>
    </div>
</div>
