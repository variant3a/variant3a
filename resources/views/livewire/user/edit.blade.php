<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="card-title fs-3 text-center">
                    Edit Profile
                </div>
                <div class="card-text text-center">
                    <form wire:submit.prevent="update" method="POST">
                        @csrf
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
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
