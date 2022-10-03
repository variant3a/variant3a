<div class="row">
    <div class="col-md-7">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <span class="ms-1 text-400">
                            Dashboard:
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
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
                    </div>
                    <div class="col-4">
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
                    </div>
                    <div class="col-4">
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
                <div class="row mb-3">
                    <div class="col-12">
                        <span class="ms-1 text-400">
                            Latest Post:
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        @if ($post)
                            <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="ps-2 py-2 fs-5 border-start border-4 border-main-500 text-break text-white text-decoration-none">
                                {{ $post->title }}
                            </a>
                            <span>
                                <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn text-bg-hover-main-500 border-0 text-nowrap">
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
    <div class="col-md-5 mt-3 mt-md-0">
        <div class="card text-bg-800">
            <div class="card-body">
                @auth
                    <textarea wire:model.lazy="memo.content" class="form-control p-3 border-0 text-bg-700 rounded shadow-none" rows="10" placeholder="Memo" style="resize:none"></textarea>
                @endauth
                @guest
                    <textarea class="form-control p-3 border-0 text-bg-700 rounded shadow-none" rows="10" placeholder="Guest account can't use this area." style="resize:none" disabled></textarea>
                @endguest
            </div>
        </div>
    </div>
</div>
