    <div class="relative flex flex-col items-center justify-center mt-8 text-center pointer-events-none text-neutral-400">
        <div class="flex items-center w-full">
            <a href="{{ route('/') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                Home
            </a>
            <a href="{{ route('post.index') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                Posts
            </a>
            <a href="{{ route('user.index') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                About me
            </a>
            <a href="{{ route('privacy-policy') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                Privacy
            </a>
            @guest
                @env('local')
                <a href="{{ route('register') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                    Register
                </a>
                @endenv
                <a href="{{ route('login') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                    Login
                </a>
            @endguest
        </div>
        <div class="flex flex-rows justify-between rounded items-center w-11/12 h-2 bg-gradient-to-r from-teal-300 to-fuchsia-300 dark:from-cyan-500/30 dark:to-purple-500/30 animate-gradient bg-[length:400%]"></div>
        <div class="flex items-center justify-end w-full">
            <div class="mx-4 my-1">
                &copy;variant3a
            </div>
        </div>
    </div>
