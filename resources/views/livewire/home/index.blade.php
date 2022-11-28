<div>
    <div class="h-[80vh]"></div>
    <div class="flex items-center justify-center shadow-inner absolute h-32 top-1/2 left-0 right-0 -translate-y-1/2 w-full m-auto bg-gradient-to-r from-teal-300 to-fuchsia-300 dark:from-cyan-500/30 dark:to-purple-500/30 animate-gradient bg-[length:400%]">
        <div class="flex items-center justify-between w-1/2 p-4 duration-300 ease-out rounded shadow-lg h-fit hover:w-2/3 hover:shadow-2xl backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20 focus:outline-none text-neutral-700 dark:text-neutral-200"
            x-data="{ hover: false }" x-on:mouseover="hover = true" x-on:mouseleave="hover = false">
            <p x-show="!hover">Welcome to variant3a's Knowledge Base.</p>
            <p x-show="hover">Will be post technical stories, knowledge and insights.</p>
            <a x-show="hover" href="{{ route('post.index') }}" class="self-center text-teal-500 underline">Visit</a>
        </div>
    </div>
    <div class="flex flex-row justify-center">

    </div>
</div>
