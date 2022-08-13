<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="card-title fs-3 text-center">
                    Edit Profile
                </div>
                <div class="card-text text-end">
                    <form wire:submit.prevent="update" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="mb-3 d-flex justify-content-center">
                                <div class="w-50 position-relative" style="height:0;padding-top:50%">
                                    <img src="{{ asset("storage/$user->profile_photo_path") }}" class="w-100 h-100 fixed-top position-absolute rounded-4" style="object-fit:cover;z-index:auto">
                                </div>
                            </div>
                            <div class="row mb-3"
                                x-data="{ droping: false, progress: 0 }"
                                x-cloak>

                                <div class="col-12 d-grid gap-2"
                                    x-on:livewire-upload-finish="droping = false;progress = 0"
                                    x-on:livewire-upload-error="droping = false;progress = 0"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label class="btn btn-outline-main-500 px-3 py-2 d-hidden"
                                        x-show="!progress"
                                        x-bind:style="{ 'border-style': droping ? 'dashed' : 'solid' }">

                                        <input type="file" wire:model="file" class="d-none" accept="image/*">
                                        Upload Image
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
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model="user.user_id" type="text" class="form-control border-700 text-bg-800" placeholder="johndoe" autocomplete="" disabled>
                            <label for="floatingInput">
                                ID
                            </label>
                            @error('user.name')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model="user.name" type="text" class="form-control border-700 text-bg-700 @error('user.name') is-invalid @enderror" placeholder="John Doe" autocomplete="name">
                            <label for="floatingInput">
                                Name
                            </label>
                            @error('user.name')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-block btn-main-500">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
