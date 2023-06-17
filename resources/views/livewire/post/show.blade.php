<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative sm:space-y-3 md:sticky md:top-24"
            x-data="{ showShareDropdown: false }">
            @auth
                <x-fab href="{{ route('post.edit') }}" class="flex items-center justify-center p-4 pr-6 mb-2 font-bold text-center bg-teal-500 shadow w-fit sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200" :style="'filled'">
                    <i class="material-icons">edit</i>
                    edit
                </x-fab>
            @endauth
            <div class="flex p-2 mb-1 shadow rounded-3xl bg-neutral-800 sm:p-3 h-fit text-neutral-400">
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
                    <x-button.primary type="button" class="flex justify-between w-full p-2 text-center" :style="'filled'"
                        x-on:click="showShareDropdown = !showShareDropdown">
                        <span class="grow">
                            share
                        </span>
                        <i class="material-icons bi bi-chevron-down"></i>
                    </x-button.primary>
                    <div class="absolute left-0 z-30 py-2 translate-y-4 rounded shadow-lg bg-neutral-700 shadow-neutral-700" x-show="showShareDropdown" x-cloak>
                        <button type="button" class="block px-4 py-2 text-neutral-300 hover:bg-teal-500/10"
                            x-on:click="
                                navigator.clipboard.writeText($wire.share_string);
                                showShareDropdown = !showShareDropdown;">
                            copy link to clipboard
                        </button>
                    </div>
                </div>
                @if (!$like)
                    <button type="button" class="flex justify-center p-2 font-semibold align-middle rounded-full shadow bg-neutral-800 grow hover:shadow-lg hover:text-teal-500 text-neutral-400" wire:click="like()">
                        <i class="px-2 material-icons">favorite_border</i>
                        {{ $reactions->count() }}
                    </button>
                @else
                    <div class="flex justify-center p-2 font-semibold text-teal-500 align-middle rounded-full shadow bg-neutral-800 grow" wire:click="like()">
                        <i class="px-2 material-icons">favorite</i>
                        {{ $reactions->count() }}
                    </div>
                @endif
            </div>
            <div class="hidden row-auto py-3 mb-1 space-y-1 overflow-y-auto font-mono shadow h-96 rounded-2xl bg-neutral-800 md:block sm:mb-3"
                x-data="{ position: '', links: document.querySelectorAll(`[id^='content-']`) }"
                x-show="links.length">
                <template x-for="link in links">
                    <a class="block w-full p-3 break-all sm:p-2 text-neutral-400 hover:bg-teal-500/10"
                        x-bind:href="`#${link.id}`"
                        x-bind:key="link.id"
                        x-text="'#'.repeat(link.parentElement.tagName.replace('H', '')) + ' ' + link.parentElement.innerText"
                        data-turbo="false"
                        x-on:scroll.window="position = [...links].filter(v => v.getBoundingClientRect().top > 0)[0]?.id || null"
                        x-bind:class="{ 'bg-teal-500/50 hover:bg-teal-500/60 text-white': position === link.id }">
                    </a>
                </template>
            </div>
        </div>
    </div>
    <div class="col-span-4 md:col-span-3">
        <div class="flex flex-col p-2 sm:p-4 bg-neutral-800 rounded-3xl h-fit">
            <div class="pl-2 mb-3 text-3xl font-bold break-all border-l-8 border-teal-500 text-break text-neutral-300">
                {{ $post->title }}
            </div>
            <div class="flex justify-between p-2 space-x-3 text-neutral-400 text-end">
                <span class="flex items-center space-x-1" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                    <i class="material-icons">calendar_today</i>
                    <span>
                        {{ $post->created_at->format('F j, Y') }}
                    </span>
                </span>
                <span class="flex items-center space-x-1">
                    <i class="material-icons">insights</i>
                    <span>
                        {{ 'views: ' . ($post->json['view'] ?? 0) }}
                    </span>
                </span>
            </div>
            <div class="flex flex-wrap">
                @if ($post->tags->count())
                    @foreach ($post->tags as $tag)
                        <div class="flex items-center mr-2 space-x-1 text-sm text-teal-500 break-all" wire:key="article-tag-{{ "$post->id-$tag->id" }}">
                            <i class="material-icons">tag</i>
                            {{ $tag->name }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="w-full mx-auto sm:w-1/2">
                @if ($post->json['thumbnail'] ?? false)
                    <img src="{{ asset($post->json['thumbnail']) }}" class="object-cover w-full h-full bg-gray-700 rounded-2xl">
                @else
                    <img src="{{ asset('images/thumbnails/laravel_transparent.png') }}" class="object-cover w-full h-full bg-gray-700 rounded-2xl">
                @endif
            </div>
            <div class="py-4 break-all sm:px-2 markdown text-neutral-700">
                {!! e(Markdown::parse($post->content)) !!}
            </div>
            <div class="flex flex-wrap">
                @if ($post->tags->count())
                    @foreach ($post->tags as $tag)
                        <div class="flex items-center mr-2 space-x-1 text-sm text-teal-500 break-all" wire:key="article-tag-{{ "$post->id-$tag->id" }}">
                            <i class="material-icons">tag</i>
                            {{ $tag->name }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="flex justify-between p-2 space-x-3 text-neutral-400 text-end">
                <span class="flex items-center space-x-1" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                    <i class="material-icons">calendar_today</i>
                    <span>
                        {{ $post->created_at->format('F j, Y') }}
                    </span>
                </span>
                <span class="flex items-center space-x-1">
                    <i class="material-icons">insights</i>
                    <span>
                        {{ 'views: ' . ($post->json['view'] ?? 0) }}
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-span-4 mb-3 md:col-start-2 md:col-span-3">
        <div class="block row-auto py-2 mb-1 bg-neutral-800 rounded-3xl sm:mb-3">
            <div class="p-4 text-neutral-400">
                most viewed
            </div>
            @if ($popular_posts->count())
                @foreach ($popular_posts as $popular_post)
                    <a href="{{ route('post.detail', $popular_post) }}" class="flex flex-col w-full p-3 space-y-2 break-all group text-neutral-400 hover:bg-teal-500/10 first:rounded-t-3xl last:rounded-b-3xl" wire:key="{{ "article-detail-$popular_post->id" }}">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center p-3">
                                <span>{{ $loop->iteration . '. ' }}</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <div class="flex justify-between text-teal-500">
                                    <span>
                                        {{ $popular_post->title }}
                                    </span>
                                </div>
                                <div class="truncate">
                                    {{ $popular_post->json['description'] ?? '' }}
                                </div>
                                <div class="flex mt-1 space-x-3 text-end">
                                    <span class="flex items-center space-x-1" title="{{ $post->created_at?->format('Y-m-d H:i:s') }}">
                                        <i class="material-icons">calendar_today</i>
                                        <span>
                                            {{ $popular_post->created_at?->format('F j, Y') ?? '' }}
                                        </span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <i class="material-icons">insights</i>
                                        <span>
                                            {{ 'views: ' . ($popular_post->json['view'] ?? 0) }}
                                        </span>
                                    </span>
                                </div>
                            </div>
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
