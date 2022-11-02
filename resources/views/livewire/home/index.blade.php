<div class="grid grid-flow-col grid-rows-1 gap-1">
    <div class="bg-white rounded shadow-lg dark:bg-zinc-700 ring-1 ring-black ring-opacity-5">
        <div class="card text-bg-700">
            <div class="card-body">
                <div class="text-main-500">
                    Posts
                </div>
                <span class="fs-5">
                    {{ $posts->count() }}
                </span>
            </div>
        </div>
        <div class="card text-bg-700">
            <div class="card-body">
                <div class="text-main-500">
                    Users
                </div>
                <span class="fs-5">
                    {{ $users->count() }}
                </span>
            </div>
        </div>
        <div class="card text-bg-700">
            <div class="card-body">
                <div class="text-main-500">
                    Last Activity
                </div>
                <span class="fs-5">
                    {{ $posts?->sortByDesc('updated_at')?->first()?->updated_at?->format('m/d H:i') ?? '' }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-12">
                        <span class="ms-1 text-400">
                            Dashboard:
                        </span>
                    </div>
                </div>
                <div class="mb-3 row">
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <span class="ms-1 text-400">
                            Latest Post:
                        </span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12 d-flex justify-content-between">
                        @if ($post)
                            <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="py-2 border-4 ps-2 fs-5 border-start border-main-500 text-break text-neutral-200 text-decoration-none">
                                {{ $post->title }}
                            </a>
                            <span>
                                <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="border-0 btn text-bg-hover-main-500 text-nowrap">
                                    Details
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </span>
                        @else
                            <span class="ms-1 text-muted">
                                No articles.
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 col-md-5 mt-md-0">
        <div class="card text-bg-800">
            <div class="card-body">
                @auth
                    <textarea wire:model.lazy="memo.content" class="p-3 border-0 rounded shadow-none form-control text-bg-700" rows="10" placeholder="Memo" style="resize:none"></textarea>
                @endauth
                @guest
                    <textarea class="p-3 border-0 rounded shadow-none form-control text-bg-700" rows="10" placeholder="Guest account can't use this area." style="resize:none" disabled></textarea>
                @endguest
            </div>
        </div>
    </div>
</div>
