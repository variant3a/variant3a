<div class="grid grid-cols-1 gap-1 md:grid-cols-4 sm:gap-3">
    <div class="col-span-4 md:col-span-1">
        <div class="relative md:sticky md:top-24">
            @auth
                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="block w-full p-2 mb-2 font-bold text-center bg-teal-500 rounded shadow sm:mb-3 hover:shadow-lg hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                    Edit
                </a>
            @endauth
            <div class="flex p-2 bg-white rounded shadow md:flex-col sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
                <div class="flex flex-col justify-center flex-shrink-0 md:mb-3 md:flex-row">
                    <div class="w-16 md:w-1/2 h-full md:h-0 pt-16 md:pt-[50%] relative aspect-square">
                        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="absolute inset-0 object-cover w-full h-full rounded-xl">
                    </div>
                </div>
                <div class="self-center mx-2">
                    <div class="text-lg break-all md:my-2 md:text-center">
                        {{ $post->user->name }}
                    </div>
                    <div class="break-all md:text-center">
                        {{ $post->user->user_id }}
                    </div>
                </div>
                <div class="self-center mx-2">
                    <p class="break-all text-neutral-400 md:text-center">
                        {{ $post->user->job }}
                    </p>
                    <p class="break-all text-neutral-400 md:mb-4 md:text-center">
                        {{ $post->user->state }}
                    </p>
                    @if ($post->user->bio)
                        <hr>
                        <p class="m-2 text-neutral-500">
                            {{ $post->user->bio }}
                        </p>
                    @endif
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
                        <input type="checkbox" wire:model="selected_tag" class="hidden" id="btn-check-{{ "$post->id-$tag->id" }}" value="{{ $tag->id }}" autocomplete="off">
                        <label class="inline mr-2 text-sm text-teal-500 break-all cursor-pointer hover:underline" for="btn-check-{{ "$post->id-$tag->id" }}">
                            <i class="bi bi-tag"></i>
                            {{ $tag->name }}
                        </label>
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
