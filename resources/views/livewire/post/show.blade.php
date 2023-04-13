<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative sm:space-y-3 md:sticky md:top-24"
            x-data="{ showShareDropdown: false }">
            @auth
                <a href="{{ route('post.edit', $post) }}" class="block w-full p-2 mb-1 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                    Edit
                </a>
            @endauth
            <div class="flex p-2 mb-1 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                <div class="flex flex-col justify-center flex-shrink-0">
                    <div class="relative w-16 h-full pt-16 aspect-square">
                        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl" alt="profile photo">
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
                    <button type="button" class="flex justify-center p-2 font-semibold align-middle bg-white rounded-full shadow grow dark:bg-zinc-700 dark:hover:text-teal-500 hover:shadow-lg hover:text-teal-500 text-neutral-400 ring-1 ring-black/5" wire:click="like()">
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
            <div class="hidden row-auto p-2 mb-1 space-y-1 font-mono bg-white rounded shadow md:block sm:mb-3 dark:bg-zinc-700 ring-1 ring-black/5"
                x-data="{ position: '', links: document.querySelectorAll(`[id^='content-']`) }"
                x-show="links.length">
                <template x-for="link in links">
                    <a class="flex justify-between w-full p-1 break-all rounded hover:bg-teal-500/50 text-neutral-700 dark:text-neutral-200 hover:text-white first:rounded-t last:rounded-b"
                        x-bind:href="`#${link.id}`"
                        x-bind:key="link.id"
                        x-text="'#'.repeat(link.parentElement.tagName.replace('H', '')) + ' ' + link.parentElement.innerText"
                        data-turbo="false"
                        x-on:scroll.window="position = [...links].filter(v => v.getBoundingClientRect().top > 0)[0]?.id || null"
                        x-bind:class="{ 'bg-teal-500/50 text-white': position === link.id }">
                    </a>
                </template>
            </div>
        </div>
    </div>
    <div class="col-span-4 md:col-span-3">
        <div class="flex flex-col p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 ring-1 ring-black/5">
            <div class="pl-2 mb-3 text-3xl font-bold break-all border-l-8 border-teal-500 text-break text-neutral-700 dark:text-neutral-200">
                {{ $post->title }}
            </div>
            <div class="flex justify-between space-x-3 text-neutral-400 text-end" href="{{ route('post.detail', $post) }}">
                <span title="{{ $post->created_at?->format('Y-m-d H:i:s') ?? '' }}" class="self-end">
                    <i class="bi bi-calendar2-event"></i>
                    {{ $post->created_at?->format('F j, Y') ?? '' }}
                </span>
                <span>
                    <i class="bi bi-bar-chart-fill"></i>
                    {{ 'Views: ' . ($post->json['view'] ?? 0) }}
                </span>
            </div>
            <div>
                @if ($post->tags->count())
                    @foreach ($post->tags as $tag)
                        <div class="inline mr-2 text-sm text-teal-500 break-all" wire:key="article-tag-{{ "$post->id-$tag->id" }}">
                            <i class="bi bi-tag"></i>
                            {{ $tag->name }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="py-4 break-all sm:px-2 markdown text-neutral-700 dark:text-neutral-200">
                {!! e(Markdown::parse($post->content)) !!}
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
                <span title="{{ $post->created_at?->format('Y-m-d H:i:s') ?? '' }}" class="self-end">
                    <i class="bi bi-calendar2-event"></i>
                    {{ $post->created_at?->format('F j, Y') }}
                </span>
                <span>
                    <i class="bi bi-bar-chart-fill"></i>
                    {{ 'Views: ' . ($post->json['view'] ?? 0) }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-span-4 mb-3 md:col-start-2 md:col-span-3">
        <div class="block row-auto mb-1 bg-white rounded shadow sm:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
            <div class="p-2 text-neutral-400">
                Most viewed
            </div>
            @if ($popular_posts->count())
                @foreach ($popular_posts as $popular_post)
                    <a href="{{ route('post.detail', $popular_post) }}" class="flex flex-col w-full p-2 break-all group text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500 first:rounded-t last:rounded-b" wire:key="{{ "article-detail-$popular_post->id" }}">
                        <div class="flex justify-between">
                            <span>
                                <span class="text-neutral-400 group-hover:text-neutral-200">{{ $loop->iteration . '. ' }}</span>
                                {{ $popular_post->title }}
                            </span>
                        </div>
                        <div class="ml-4 truncate text-neutral-400 group-hover:text-neutral-200">
                            {{ $popular_post->json['description'] ?? '' }}
                        </div>
                        <div class="flex mt-1 space-x-3 text-neutral-400 group-hover:text-neutral-200 text-end">
                            <span title="{{ $post->created_at?->format('Y-m-d H:i:s') ?? '' }}" class="text-end">
                                <i class="bi bi-calendar2-event"></i>
                                {{ $popular_post->created_at?->format('F j, Y') ?? '' }}
                            </span>
                            <span>
                                <i class="bi bi-bar-chart-fill"></i>
                                {{ 'Views: ' . ($popular_post->json['view'] ?? 0) }}
                            </span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <script type="application/ld+json">
        [
            {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Posts",
                    "item": "{{ route('post.index') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $post->title }}"
                }]
            },
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "url": "{{ config('app.url') }}",
                "logo": "{{ asset('images/logo_only_transparent_trim.png') }}",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ url()->current() }}"
                },
                "headline": "{{ $post->title }}",
                "description": "{{ $post->json['description'] ?? '' }}",
                "author": {
                    "@type": "Person",
                    "name": "{{ $post->user->name }}",
                    "url": "{{ config('app.url') }}",
                    "image": "{{ $post->user->profile_photo_path }}",
                    "jobTitle": "{{ $post->user->json['job'] ?? '' }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ config('app.name', 'Laravel') }}",
                    "logo":{
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo_only_transparent_trim.png') }}",
                        "width": "512",
                        "height": "512"
                    }
                },
                "datePublished": "{{ $post->created_at }}",
                "dateModified": "{{ $post->updated_at }}"
            }
        ]
    </script>
</div>
