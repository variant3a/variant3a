<div class="grid grid-cols-1 gap-1 md:grid-cols-2 sm:gap-3">
    <div class="col-span-2 md:col-span-1">
        <div class="flex flex-col items-stretch p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 sm:gap-3">
                <div class="flex flex-col w-full col-span-3 p-2 bg-white rounded shadow md:col-span-1 sm:p-3 dark:bg-zinc-600 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                    <div class="text-main-500">
                        Posts
                    </div>
                    <span class="fs-5">
                        {{ $posts->count() }}
                    </span>
                </div>
                <div class="flex flex-col w-full col-span-3 p-2 bg-white rounded shadow md:col-span-1 sm:p-3 dark:bg-zinc-600 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                    <div class="text-main-500">
                        Users
                    </div>
                    <span class="fs-5">
                        {{ $users->count() }}
                    </span>
                </div>
                <div class="flex flex-col w-full col-span-3 p-2 bg-white rounded shadow md:col-span-1 sm:p-3 dark:bg-zinc-600 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                    <div class="text-main-500">
                        Last Activity
                    </div>
                    <span class="fs-5">
                        {{ $posts?->sortByDesc('updated_at')?->first()?->updated_at?->format('m/d H:i') ?? '' }}
                    </span>
                </div>
            </div>
            @if ($post)
                <a href="{{ route('post.detail', $post) }}" class="p-2 pb-0 break-all text-neutral-700 dark:text-neutral-200 hover:text-teal-500 dark:hover:text-teal-500">
                    {{ $post->title }}
                </a>
            @else
                <span class="p-2 pb-0 text-neutral-400">
                    No articles.
                </span>
            @endif
        </div>
    </div>
    <div class="col-span-2 mb-3 md:col-span-1">
        <div class="flex flex-col p-2 bg-white rounded shadow sm:p-3 h-fit dark:bg-zinc-700 ring-1 ring-black/5">
            @auth
                <textarea wire:model.lazy="memo.content" class="w-full p-2 bg-white rounded dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" rows="10" placeholder="Memo" style="resize:none"
                    x-data="{ start: 0 }"
                    x-on:keydown.tab.prevent="
                    start = $el.selectionStart
                    $el.value = $el.value.substr(0, $el.selectionEnd) + '    ' + $el.value.substr($el.selectionEnd);
                    $el.selectionStart = $el.selectionEnd = start + 4;
                "></textarea>
            @endauth
            @guest
                <textarea class="w-full p-2 bg-white rounded dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" rows="10" placeholder="Guest account can't use this area." style="resize:none" disabled
                    x-data="{ start: 0 }"
                    x-on:keydown.tab.prevent="
                    start = $el.selectionStart
                    $el.value = $el.value.substr(0, $el.selectionEnd) + '    ' + $el.value.substr($el.selectionEnd);
                    $el.selectionStart = $el.selectionEnd = start + 4;
                "></textarea>
            @endguest
        </div>
