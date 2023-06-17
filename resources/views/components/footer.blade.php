    <div class="relative flex flex-col items-center justify-center mt-8 text-center pointer-events-none text-neutral-400">
        <div class="flex flex-wrap items-center w-11/12">
            <a href="{{ route('/') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                home
            </a>
            <a href="{{ route('post.index') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                posts
            </a>
            <a href="{{ route('user.index') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                about me
            </a>
            <a href="{{ route('privacy-policy') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                privacy
            </a>
            @guest
                @env('local')
                <a href="{{ route('register') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                    register
                </a>
                @endenv
                <a href="{{ route('login') }}" class="block mx-4 my-1 text-teal-500 cursor-pointer pointer-events-auto hover:underline">
                    login
                </a>
            @endguest
        </div>
        <div class="flex flex-rows justify-between rounded items-center w-11/12 h-2 bg-gradient-to-r from-teal-300 to-fuchsia-300 animate-gradient bg-[length:400%]"></div>
        <div class="flex items-center justify-end w-11/12">
            <div class="mx-4 my-1">
                &copy;variant3a
            </div>
        </div>
    </div>
