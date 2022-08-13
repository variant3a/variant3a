<div class="row">
    <div class="col-md-4">
        <div class="card mb-3 text-bg-800">
            <div class="card-body text-center">
                <div class="mb-3 d-flex justify-content-center">
                    <div class="w-50 position-relative" style="height:0;padding-top:50%">
                        <img src="{{ asset("storage/$user->profile_photo_path") }}" class="w-100 h-100 fixed-top position-absolute rounded-circle" style="object-fit:cover;z-index:auto">
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
    <div class="col-md-8">
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
</div>
