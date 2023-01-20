<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative md:sticky md:top-24">
            @auth
                <a href="{{ route('post.edit') }}" class="block w-full p-2 mb-2 font-bold text-center bg-teal-500 rounded shadow sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                    Create
                </a>
            @endauth
            <div class="p-3 pb-1 bg-white rounded shadow md:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
                <input type="text" wire:model="keyword" class="w-full p-2 mb-3 bg-white rounded text-neutral-700 dark:text-neutral-200 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" placeholder="Keywords">
                @if ($tags->count())
                    <div class="flex flex-row flex-wrap">
                        @foreach ($tags as $search_tag)
                            <span wire:key="{{ "search-tag-$search_tag->id" }}">
                                <input type="checkbox" wire:model="selected_tag" class="hidden peer" value="{{ $search_tag->id }}" id="btn-search-{{ $search_tag->id }}" autocomplete="off">
                                <label class="block px-2 mb-2 mr-2 text-teal-500 break-all border-2 border-teal-500 rounded cursor-pointer hover:bg-teal-500 peer-checked:bg-teal-500 hover:text-neutral-200 peer-checked:text-neutral-200 ring-1 ring-black/5" for="btn-search-{{ $search_tag->id }}">
                                    {{ "$search_tag->name ($search_tag->posts_count)" }}
                                </label>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="hidden row-auto mb-1 bg-white rounded shadow md:block sm:mb-3 dark:bg-zinc-700 ring-1 ring-black/5">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <a href="{{ route('post.detail', $post) }}" class="block w-full p-1 break-all sm:p-2 text-neutral-700 dark:text-neutral-200 hover:text-neutral-200 hover:bg-teal-500 first:rounded-t last:rounded-b" wire:key="{{ "article-detail-$post->id" }}">
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
                    <div class="flex flex-col px-2 py-2 bg-white rounded shadow md:px-4 h-fit dark:bg-zinc-700 hover:shadow-lg ring-1 ring-black/5" wire:key="{{ "article-$post->id" }}">
                        <a href="{{ route('post.detail', $post) }}" id="{{ "post-$post->id" }}" class="text-2xl font-bold break-all text-neutral-700 dark:text-neutral-200 hover:text-teal-500 dark:hover:text-teal-500">
                            {{ $post->title }}
                        </a>
                        <div class="text-neutral-400">
                            {{ '@' . $post->user->user_id }}
                        </div>
                        <div class="px-2 py-4 markdown text-neutral-700 dark:text-neutral-200 max-h-[25vh] break-words overflow-hidden break-all">
                            {!! e(App\Services\MarkdownService::parse(strip_tags($post->content))) !!}
                        </div>
                        @if ($post->tags->count())
                            <div class="py-2">
                                @foreach ($post->tags as $tag)
                                    <input type="checkbox" wire:model="selected_tag" class="hidden" id="btn-check-{{ "$post->id-$tag->id" }}" value="{{ $tag->id }}" autocomplete="off">
                                    <label class="inline mr-2 text-sm text-teal-500 cursor-pointer hover:underline" for="btn-check-{{ "$post->id-$tag->id" }}">
                                        <i class="bi bi-tag"></i>
                                        {{ $tag->name }}
                                    </label>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex justify-between mb-0 text-neutral-400 text-end" href="{{ route('post.detail', $post) }}">
                            <span class="space-x-3">
                                <span>
                                    <i class="bi bi-bar-chart-fill"></i>
                                    {{ 'Views: ' . $post->json['view'] }}
                                </span>
                                <span title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                                    <i class="bi bi-calendar2-event"></i>
                                    {{ $post->created_at->format('F j, Y') }}
                                </span>
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-1 sm:p-2">
                    <p class="card-text">
                        There is no articles.
                    </p>
                </div>
            @endif
        </div>
        <div class="flex justify-center mb-5">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</div>
