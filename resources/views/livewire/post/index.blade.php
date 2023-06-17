<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative space-y-3 md:sticky md:top-24">
            @auth
                <x-fab href="{{ route('post.edit') }}" class="flex items-center justify-center p-4 pr-6 mb-2 font-bold text-center bg-teal-500 shadow w-fit sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200" :style="'filled'">
                    <i class="material-icons">edit</i>
                    create
                </x-fab>
            @endauth
            <x-search type="text" wire:model="keyword" class="w-full" placeholder="search" />
            <div class="flex flex-col h-full p-3 pb-1 rounded-2xl bg-neutral-800 md:mb-3">
                @if ($tags->count())
                    <div class="flex flex-row flex-wrap">
                        @foreach ($tags as $search_tag)
                            <span wire:key="{{ "search-tag-$search_tag->id" }}">
                                <input type="checkbox" wire:model="selected_tag" class="hidden peer" value="{{ $search_tag->id }}" id="btn-search-{{ $search_tag->id }}" autocomplete="off">
                                <x-chip class="flex items-center" for="btn-search-{{ $search_tag->id }}">
                                    <i class="material-icons">tag</i>
                                    {{ "$search_tag->name ($search_tag->posts_count)" }}
                                </x-chip>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="hidden row-auto py-3 mb-1 shadow bg-neutral-800 rounded-2xl md:block sm:mb-3">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <a href="{{ route('post.detail', $post) }}" class="block w-full p-3 break-all sm:p-2 text-neutral-400 hover:bg-teal-500/10" wire:key="{{ "article-detail-$post->id" }}">
                            {{ $post->title }}
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="justify-center hidden mb-5 md:flex">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
    <div class="col-span-4 md:col-span-3">
        <div class="grid grid-cols-1 gap-1 mb-1 sm:gap-3 sm:grid-cols-2 sm:mb-3">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <a href="{{ route('post.detail', $post) }}" class="flex flex-col h-full p-2 space-y-2 hover:bg-neutral-700 rounded-3xl bg-neutral-800" wire:key="{{ "article-$post->id" }}">
                        <div class="w-full h-0 pt-[50%] relative">
                            @if ($post->json['thumbnail'] ?? false)
                                <img src="{{ $post->json['thumbnail'] }}" class="absolute inset-0 object-cover w-full h-full rounded-xl">
                            @else
                                <img src="{{ asset('images/thumbnails/laravel_transparent.png') }}" class="absolute inset-0 object-cover w-full h-full bg-gray-700 rounded-2xl">
                            @endif
                        </div>
                        <div class="text-2xl font-bold text-teal-500 break-all">
                            {{ $post->title }}
                        </div>
                        <div class="text-neutral-400">
                            {{ '@' . $post->user->user_id }}
                        </div>
                        <div class="h-full px-2 overflow-hidden line-clamp-3 text-neutral-400">
                            {{ $post->json['description'] ?? '' }}
                        </div>
                        @if ($post->tags->count())
                            <div class="flex">
                                @foreach ($post->tags as $tag)
                                    <input type="checkbox" wire:model="selected_tag" class="hidden" id="btn-check-{{ "$post->id-$tag->id" }}" value="{{ $tag->id }}" autocomplete="off">
                                    <label class="flex items-center mr-2 space-x-1 text-sm text-teal-500 cursor-pointer" for="btn-check-{{ "$post->id-$tag->id" }}">
                                        <i class="material-icons">tag</i>
                                        <span>
                                            {{ $tag->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex justify-between p-2 space-x-3 text-neutral-400 text-end">
                            <span class="flex items-center space-x-1">
                                <i class="material-icons">insights</i>
                                <span>
                                    {{ 'views: ' . ($post->json['view'] ?? 0) }}
                                </span>
                            </span>
                            <span class="flex items-center space-x-1" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                                <i class="material-icons">calendar_today</i>
                                <span>
                                    {{ $post->created_at->format('F j, Y') }}
                                </span>
                            </span>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="p-1 sm:p-2">
                    <p class="card-text">
                        there is no articles.
                    </p>
                </div>
            @endif
        </div>
        <div class="flex justify-center mb-5">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</div>
