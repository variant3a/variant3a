<nav class="navbar p-0 fixed-top navbar-expand-md bg-dark shadow">
    <div class="container-xxl p-0 d-flex justify-content-between">
        <ul class="navbar-nav text-center">
            <li class="nav-item">
                <a class="btn btn-link navbar-toggler border-0 rounded-0 text-main-500" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-expanded="false" style="width:5rem">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav text-center flex-column flex-md-row">
            <li id="logo" class="nav-item">
                <a href="{{ route('home.index') }}" id="random-emoji" class="nav-link py-3 border-left rounded-0 text-main-500" style="width:5rem" style="width:5rem" data-bs-toggle="tooltip" data-bs-placement="bottom" title="&#128512">
                    <img src="{{ asset('images/mstile-310x310.png') }}" class="bg-transparent" style="width:1.5rem;height:auto">
                </a>
            </li>
        </ul>
        <div class="offcanvas offcanvas-start bg-dark border-0" tabindex="-1" id="offcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-main-500">
                    variant3a
                </h5>
                <a href="{{ route('home.index') }}" class="btn btn-link navbar-toggler border-0 rounded-0 text-main-500" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="bi bi-x-lg fs-4"></i>
                </a>
            </div>
            <div class="px-0 offcanvas-body justify-content-center">
                <ul class="navbar-nav text-center flex-column flex-md-row">
                    <li class="nav-item">
                        <a href="{{ route('home.index') }}" class="d-flex nav-link py-3 border-left rounded-0 align-items-center text-main-500 text-bg-hover-main-500" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home">
                            <div class="" style="width:4rem">
                                <i class="bi bi-house-door-fill fs-4"></i>
                            </div>
                            <div class="d-md-none">
                                Home
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="d-flex nav-link py-3 border-left rounded-0 align-items-center text-main-500 text-bg-hover-main-500" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Blog">
                            <div class="" style="width:4rem">
                                <i class="bi bi-newspaper fs-4"></i>
                            </div>
                            <div class="d-md-none">
                                Blog
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="d-flex nav-link py-3 border-left rounded-0 align-items-center text-main-500 text-bg-hover-main-500" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profile">
                            <div class="" style=" width:4rem">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div class="d-md-none">
                                Profile
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav text-center flex-column flex-md-row">
            <li class="nav-item dropdown">
                <a href="" class="nav-link py-3 border-left rounded-0 text-main-500 text-bg-hover-main-500" style="width:5rem" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical fs-4"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end position-absolute">
                    @auth
                        <li>
                            <a class="dropdown-item" href="#">
                                Edit Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-red-600">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        @env('local')
                        <li>
                            <a class="dropdown-item" href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                        @endenv
                        <li>
                            <a class="dropdown-item" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @endguest
                </ul>
            </li>
        </ul>
    </div>
</nav>
