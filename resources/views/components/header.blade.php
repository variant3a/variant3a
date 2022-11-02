<div
    x-data="{ showDropdown: false, showSideNav: (window.innerWidth >= 768) ? true : false }">
    <div class="fixed z-10 m-1 sm:m-3 top-0 left-0 w-[calc(100%_-_0.5rem)] sm:w-[calc(100%_-_1.5rem)] shadow-lg rounded backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20">
        <div class="flex justify-between">
            <div class="relative flex items-center justify-between z-1 md:hidden">
                <button type="button" class="inline-block h-16 p-5 text-center no-underline rounded-l hover:text-neutral-200 hover:bg-teal-500/50"
                    x-on:click="showSideNav = !showSideNav"
                    :class="showSideNav ? 'bg-teal-500 text-neutral-200' : 'text-teal-500'">
                    <i class="self-center px-1 text-xl bi bi-list"></i>
                </button>
            </div>
            <div class="relative flex items-center justify-between h-16 px-4 z-1">
                <a href="{{ url()->current() }}" id="random-emoji" class="inline-block">
                    <img src="{{ asset('images/logo_only_transparent_trim.png') }}" class="w-8 h-auto">
                </a>
            </div>
            <div class="relative z-20 flex items-center justify-between h-16">
                <div class="fixed inset-0 w-screen h-screen" x-on:click="showDropdown = !showDropdown" x-show="showDropdown" x-on: x-cloak></div>
                <button type="button" class="inline-block h-16 p-5 rounded-r hover:text-neutral-200 hover:bg-teal-500/50"
                    x-on:click="showDropdown = !showDropdown"
                    :class="showDropdown ? 'bg-teal-500 text-neutral-200' : 'text-teal-500'">
                    <i class="self-center px-1 text-xl bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 z-20 w-screen h-screen md:hidden" x-on:click="showSideNav = !showSideNav" x-show="showSideNav" x-cloak></div>
    <div class="fixed z-30 md:pointer-events-none top-20 sm:top-24 left-1 sm:left-3 md:inset-0 md:m-3 w-[calc(100vw_-_0.5rem)] sm:w-[calc(100vw_-_1.5rem)] max-h-[calc(100vh_-_6.25rem)] shadow-lg md:shadow-none md:backdrop-blur-0 bg-zinc-200/20 md:bg-transparent dark:bg-white/10 dark:md:bg-transparent rounded backdrop-blur-lg ring-1 ring-white/40 dark:ring-white/20 md:ring-0 overflow-auto" x-show="showSideNav" x-cloak x-transition>
        <div class="flex flex-col flex-1 md:flex-row md:justify-center">
            <div class="flex p-5 md:hidden">
                <h5 class="inline-block my-0 font-semibold text-neutral-700 dark:text-neutral-200">
                    variant3a
                </h5>
            </div>
            <a href="{{ route('home.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                <i class="self-center px-1 text-xl bi bi-house-door-fill"></i>
                <div class="mx-5 md:hidden">
                    Home
                </div>
            </a>
            <a href="{{ route('post.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                <i class="self-center px-1 text-xl bi bi-newspaper"></i>
                <div class="mx-5 md:hidden">
                    Posts
                </div>
            </a>
            <a href="{{ route('user.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                <i class="self-center px-1 text-xl bi bi-person-workspace"></i>
                <div class="mx-5 md:hidden">
                    About Me
                </div>
            </a>
            @auth
                {{-- <a href="{{ route('internal.dashboard.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                    x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                    <i class="self-center px-1 text-xl bi bi-boxes"></i>
                    <div class="mx-5 md:hidden">
                        Internal System
                    </div>
                </a>
                <a href="{{ route('internal.dashboard.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                    x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                    <i class="self-center px-1 text-xl bi bi-bar-chart-steps"></i>
                    <div class="mx-5 md:hidden">
                        Projects
                    </div>
                </a> --}}
                <a href="{{ route('internal.schedule.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                    x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                    <i class="self-center px-1 text-xl bi bi-calendar-week"></i>
                    <div class="mx-5 md:hidden">
                        Schedules
                    </div>
                </a>
                {{-- <a href="{{ route('internal.dashboard.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                    x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                    <i class="self-center px-1 text-xl bi bi-coin"></i>
                    <div class="mx-5 md:hidden">
                        Expenses
                    </div>
                </a>
                <a href="{{ route('internal.dashboard.index') }}" class="flex h-16 p-5 text-teal-500 hover:text-neutral-200 hover:bg-teal-500/50 md:pointer-events-auto"
                    x-on:click="showSideNav = (window.innerWidth >= 768) ? showSideNav : !showSideNav">
                    <i class="self-center px-1 text-xl bi bi-journals"></i>
                    <div class="mx-5 md:hidden">
                        Notes
                    </div>
                </a> --}}
            @endauth
        </div>
    </div>
    <div class="fixed z-30 w-56 rounded shadow-lg top-20 sm:top-24 right-1 sm:right-3 backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20 focus:outline-none" x-show="showDropdown" x-cloak x-transition>
        <div class="py-1">
            <button type="button" class="block w-full px-4 py-2 text-sm text-left text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50"
                x-on:click="changeTheme">
                Switch Theme
            </button>
            @auth
                <a class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50" href="{{ route('user.edit') }}"
                    x-on:click="showDropdown = (window.innerWidth >= 768) ? showDropdown : !showDropdown">
                    Edit Profile
                </a>
                <a class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50" href="{{ route('setting.index') }}"
                    x-on:click="showDropdown = (window.innerWidth >= 768) ? showDropdown : !showDropdown">
                    Settings
                </a>
                <hr class="dropdown-divider">
                <form action="{{ route('logout') }}" method="post"
                    x-on:click="showDropdown = (window.innerWidth >= 768) ? showDropdown : !showDropdown">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm text-left text-red-500 hover:text-neutral-200 hover:bg-red-500/50" data-turbo="false">
                        Logout
                    </button>
                </form>
            @endauth
            @guest
                @env('local')
                <a class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50" href="{{ route('register') }}"
                    x-on:click="showDropdown = (window.innerWidth >= 768) ? showDropdown : !showDropdown">
                    Register
                </a>
                @endenv
                <a class="block px-4 py-2 text-sm text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50" href="{{ route('login') }}"
                    x-on:click="showDropdown = (window.innerWidth >= 768) ? showDropdown : !showDropdown">
                    Login
                </a>
            @endguest
        </div>
    </div>
</div>
