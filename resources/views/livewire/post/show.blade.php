<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative space-y-1 sm:space-y-3 md:sticky md:top-24"
            x-data="{ showShareDropdown: false }">
            @auth
                <a href="{{ route('post.edit', $post) }}" class="block w-full p-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                    Edit
                </a>
            @endauth
            <div class="flex p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                <div class="flex flex-col justify-center flex-shrink-0">
                    <div class="relative w-16 h-full pt-16 aspect-square">
                        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl">
                    </div>
                </div>
                <div class="self-center mx-2">
                    <div class="text-lg break-all">
                        {{ $post->user->name }}
                    </div>
                    <div class="break-all">
                        {{ '@' . $post->user->user_id }}
                    </div>
                </div>
                <div class="self-center hidden mx-2">
                    <p class="break-all text-neutral-400">
                        {{ $post->user->job }}
                    </p>
                    <p class="break-all text-neutral-400">
                        {{ $post->user->state }}
                    </p>
                </div>
            </div>
            <div class="flex justify-between space-x-3">
                <div class="grow">
                    <button type="button" class="flex justify-between w-full p-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5"
                        x-on:click="showShareDropdown = !showShareDropdown">
                        <span class="grow">
                            Share
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="absolute left-0 z-30 rounded shadow-lg sm:mt-3 backdrop-blur-lg bg-zinc-200/20 dark:bg-white/10 ring-1 ring-white/40 dark:ring-white/20 focus:outline-none" x-show="showShareDropdown" x-cloak x-transition>
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
                @if (!$like)
                    <button type="button" class="flex justify-center p-2 font-semibold align-middle bg-white rounded-full shadow grow dark:bg-zinc-700 dark:text-neutral-200 dark:hover:text-teal-500 hover:shadow-lg hover:text-teal-500 text-neutral-200 ring-1 ring-black/5" wire:click="like()">
                        <i class="px-2 bi bi-heart"></i>
                        {{ $reactions->count() }}
                    </button>
                @else
                    <div class="flex justify-center p-2 font-semibold text-teal-500 align-middle bg-white rounded-full shadow grow dark:bg-zinc-700 ring-1 ring-black/5" wire:click="like()">
                        <i class="px-2 bi bi-heart-fill"></i>
                        {{ $reactions->count() }}
                    </div>
                @endif
            </div>
            <div class="hidden row-auto mb-1 bg-white rounded shadow md:block sm:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
                <div class="p-2 text-neutral-400">
                    Most viewed
                </div>
                @if ($popular_posts->count())
                    @foreach ($popular_posts as $popular_post)
                        <a href="{{ route('post.detail', $popular_post) }}" class="flex justify-between w-full p-1 break-all sm:p-2 text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500 first:rounded-t last:rounded-b" wire:key="{{ "article-detail-$popular_post->id" }}">
                            <span>{{ $loop->iteration . '. ' . $popular_post->title }}</span>
                            {{-- <span>
                                <i class="bi bi-bar-chart-fill"></i>
                                {{ $popular_post->json['view'] ?? 0 }}
                            </span> --}}
                        </a>
                    @endforeach
                @endif
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
            <div class="py-2">
                @if ($post->tags->count())
                    @foreach ($post->tags as $tag)
                        <div class="inline mr-2 text-sm text-teal-500 break-all" wire:key="article-tag-{{ "$post->id-$tag->id" }}">
                            <i class="bi bi-tag"></i>
                            {{ $tag->name }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="flex mb-0 space-x-3 text-neutral-400 text-end" href="{{ route('post.detail', $post) }}">
                <span>
                    <i class="bi bi-bar-chart-fill"></i>
                    {{ 'Views: ' . ($post->json['view'] ?? 0) }}
                </span>
                <span title="{{ $post->created_at->format('Y-m-d H:i:s') }}" class="self-end">
                    <i class="bi bi-calendar2-event"></i>
                    {{ $post->created_at->format('F j, Y') }}
                </span>
            </div>
        </div>
    </div>
</div>
