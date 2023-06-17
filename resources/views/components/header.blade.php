<div class="container fixed z-40 flex justify-between p-4 -translate-x-1/2 left-1/2">
    <div class="flex w-full space-x-2" x-data="{ nav: false }">
        <div class="relative w-full space-y-2 sm:hidden">
            <button type="button" class="flex items-center justify-center p-2 text-teal-900 transition bg-teal-400 rounded-full" x-bind:class="nav ? 'shadow-xl drop-shadow-xl' : ''" x-on:click="nav = !nav">
                <i class="self-center px-1 text-xl material-icons">menu</i>
            </button>
            <div class="absolute z-40 space-y-2">
                <a href="{{ route('/') }}" class="flex items-center p-2 pr-8 text-teal-900 transition bg-teal-400 rounded-full shadow-xl drop-shadow-xl hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400" x-show="nav" x-on:click="nav = false" x-on:click.away="nav = false" x-cloak
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="transform -translate-x-[150%]"
                    x-transition:enter-end="transform scale-x-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-150 delay-150"
                    x-transition:leave-start="transform scale-x-100 translate-x-0"
                    x-transition:leave-end="transform -translate-x-[150%]">
                    <i class="self-center px-1 text-xl material-icons">home</i>
                    <div class="">
                        home
                    </div>
                </a>
                <a href="{{ route('post.index') }}" class="flex items-center p-2 pr-8 text-teal-900 transition bg-teal-400 rounded-full shadow-xl drop-shadow-xl hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400" x-show="nav" x-on:click="nav = false" x-on:click.away="nav = false" x-cloak x-transition:enter="transition ease-out duration-150 delay-75"
                    x-transition:enter-start="transform -translate-x-[150%]"
                    x-transition:enter-end="transform scale-x-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-150 delay-75"
                    x-transition:leave-start="transform scale-x-100 translate-x-0"
                    x-transition:leave-end="transform -translate-x-[150%]">
                    <i class="self-center px-1 text-xl material-icons">newspaper</i>
                    <div class="">
                        posts
                    </div>
                </a>
                <a href="{{ route('user.index') }}" class="flex items-center p-2 pr-8 text-teal-900 transition bg-teal-400 rounded-full shadow-xl drop-shadow-xl hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400" x-show="nav" x-on:click="nav = false" x-on:click.away="nav = false" x-cloak x-transition:enter="transition ease-out duration-150 delay-150"

                    x-transition:enter-start="transform -translate-x-[150%]"
                    x-transition:enter-end="transform scale-x-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="transform scale-x-100 translate-x-0"
                    x-transition:leave-end="transform -translate-x-[150%]">
                    <i class="self-center px-1 text-xl material-icons">person</i>
                    <div class="">
                        about me
                    </div>
                </a>
            </div>
        </div>
        <a href="{{ route('/') }}" class="items-center justify-center hidden p-2 pr-6 text-teal-900 transition bg-teal-400 rounded-full hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400 sm:flex">
            <i class="self-center px-1 text-xl material-icons">home</i>
            <div class="">
                home
            </div>
        </a>
        <a href="{{ route('post.index') }}" class="items-center justify-center hidden p-2 pr-6 text-teal-900 transition bg-teal-400 rounded-full sm:flex hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400">
            <i class="self-center px-1 text-xl material-icons">newspaper</i>
            <div class="">
                posts
            </div>
        </a>
        <a href="{{ route('user.index') }}" class="items-center justify-center hidden p-2 pr-6 text-teal-900 transition bg-teal-400 rounded-full sm:flex hover:bg-teal-300 disabled:bg-neutral-700 disabled:text-neutral-400">
            <i class="self-center px-1 text-xl material-icons">person</i>
            <div class="">
                about me
            </div>
        </a>
    </div>
    <div class="relative" x-data="{ menu: false }" x-on:click.away="menu = false">
        <x-button.primary type="button" class="flex items-center justify-center p-2" x-on:click="menu = !menu">
            <i class="self-center px-1 text-xl material-icons">more_vert</i>
        </x-button.primary>
        <div class="absolute right-0 z-40 w-48 py-2 translate-y-4 rounded shadow-lg bg-neutral-700 shadow-neutral-700" x-show="menu" x-on:click="menu = false">
            @auth
                <a class="block px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="{{ route('user.edit') }}">
                    edit profile
                </a>
                <a class="block px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="{{ route('setting.index') }}">
                    settings
                </a>
                <hr class="my-2 dropdown-divider">
                <a class="flex justify-between px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="https://hr.variant3a.com" target="_blank">
                    hr
                    <i class="px-2 material-icons">open_in_new</i>
                </a>
                <a class="flex justify-between px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="https://jenkins.variant3a.com" target="_blank">
                    jenkins
                    <i class="px-2 material-icons">open_in_new</i>
                </a>
                <a class="flex justify-between px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="https://pma.variant3a.com" target="_blank">
                    phpmyadmin
                    <i class="px-2 material-icons">open_in_new</i>
                </a>
                <a class="flex justify-between px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="https://cockpit.variant3a.com" target="_blank">
                    cockpit
                    <i class="px-2 material-icons">open_in_new</i>
                </a>
                <a class="flex justify-between px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="{{ route('telescope') }}" target="_blank">
                    telescope
                    <i class="px-2 material-icons">open_in_new</i>
                </a>
                <hr class="my-2 dropdown-divider">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-left text-red-500 hover:bg-red-500/10" data-turbo="false">
                        logout
                    </button>
                </form>
            @endauth
            @guest
                @env('local')
                <a class="block px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="{{ route('register') }}">
                    register
                </a>
                @endenv
                <a class="block px-4 py-2 text-neutral-300 hover:bg-teal-500/10" href="{{ route('login') }}">
                    login
                </a>
            @endguest
        </div>
    </div>
</div>
