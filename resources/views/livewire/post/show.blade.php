<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative md:sticky md:top-24"
            x-data="{ showShareDropdown: false }">
            @auth
                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="block w-full p-2 mb-2 font-bold text-center bg-teal-500 rounded shadow sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                    Edit
                </a>
            @endauth
            <div class="flex mb-1 sm:mb-3 p-2 bg-white rounded shadow md:flex-col sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                <div class="flex flex-col justify-center flex-shrink-0 md:mb-3 md:flex-row">
                    <div class="w-16 md:w-1/2 h-full md:h-0 pt-16 md:pt-[50%] relative aspect-square">
                        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl">
                    </div>
                </div>
                <div class="self-center mx-2">
                    <div class="text-lg break-all md:my-2 md:text-center">
                        {{ $post->user->name }}
                    </div>
                    <a href="{{ route('user.index', $post->user->user_id) }}" class="block break-all md:text-center text-teal-500 hover:underline">
                        {{ '@' . $post->user->user_id }}
                    </a>
                </div>
                <div class="self-center hidden mx-2 md:block">
                    <p class="break-all text-neutral-400 md:text-center">
                        {{ $post->user->job }}
                    </p>
                    <p class="break-all text-neutral-400 md:mb-4 md:text-center">
                        {{ $post->user->state }}
                    </p>
                    @if ($post->user->bio)
                        <hr>
                        <p class="my-3 break-all text-neutral-400">
                            {!! nl2br(e($post->user->bio)) !!}
                        </p>
                    @endif
                </div>
            </div>
            <button type="button" class="w-full p-2 flex justify-between font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5"
                x-on:click="showShareDropdown = !showShareDropdown">
                <i class="bi bi-chevron-down invisible"></i>
                Share
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="absolute mt-1 sm:mt-3 z-30 w-full right-0 rounded shadow-lg backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20 focus:outline-none" x-show="showShareDropdown" x-cloak x-transition>
                <div class="py-1">
                    <button type="button" class="block w-full px-4 py-2 text-sm text-left text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500/50"
                        x-on:click="
                            navigator.clipboard.writeText($wire.share_string);
                            showShareDropdown = !showShareDropdown;">
                        Copy link to clipboard
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-4 mb-3 md:col-span-3">
        <div class="flex flex-col p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 ring-1 ring-black/5">
            <div class="pl-2 text-3xl font-bold break-all border-l-8 border-teal-500 text-break text-neutral-700 dark:text-neutral-200">
                {{ $post->title }}
            </div>
            <div class="py-4 break-all sm:px-2 markdown text-neutral-700 dark:text-neutral-200">
                {!! e(App\Services\MarkdownService::parse($post->content)) !!}
            </div>
            @if ($post->tags->count())
                <div class="py-2">
                    @foreach ($post->tags as $tag)
                        <div class="inline mr-2 text-sm text-teal-500 break-all">
                            <i class="bi bi-tag"></i>
                            {{ $tag->name }}
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="flex mb-0 text-neutral-400 text-end" href="{{ route('post.detail', ['id' => $post->id]) }}">
                <span title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                    {{ $post->created_at->format('F j, Y') }}
                </span>
            </div>
        </div>
    </div>
</div>
