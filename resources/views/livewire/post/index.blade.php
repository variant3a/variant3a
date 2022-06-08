<div class="row">
    <div class="col-md-3">
        <div class="sticky-md-top" style="top:6rem">
            @auth
                <div class="row mb-3">
                    <div class="col-12 d-grid gap-2">
                        <a href="{{ route('post.create') }}" class="btn btn-main-500">
                            Create
                        </a>
                    </div>
                </div>
            @endauth
            <div class="row mb-3">
                <div class="col-12 d-grid gap-2">
                    <div class="card text-bg-800">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" wire:model="keyword" class="form-control border-700 text-bg-700" placeholder="Keywords">
                                </div>
                            </div>
                            @if ($tags->count())
                                <div class="row mt-3">
                                    <div class="col-12">
                                        @foreach ($tags as $search_tag)
                                            <input type="checkbox" wire:model="selected_tag" class="btn-check" id="btn-search-{{ $search_tag->id }}" value="{{ $search_tag->id }}" autocomplete="off">
                                            <label class="mb-1 px-3 btn btn-outline-main-500 btn-sm" for="btn-search-{{ $search_tag->id }}">
                                                {{ "$search_tag->name ($search_tag->posts_count)" }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card text-bg-800">
                    @if ($posts->count())
                        @foreach ($posts as $post)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <h5 class="ps-2 py-2 border-start border-4 border-main-500">
                                            {{ $post->title }}
                                        </h5>
                                        <span>
                                            <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn text-bg-hover-main-500 border-0">
                                                Details
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 text-500 d-flex justify-content-between">
                                        <span>
                                            {{ $post->user->name }}
                                        </span>
                                        <span>
                                            {{ $post->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {!! e(Illuminate\Mail\Markdown::parse($post->content)) !!}
                                    </div>
                                </div>
                                @if ($post->tags->count())
                                    <div class="row mt-3">
                                        <div class="col-12 text-500">
                                            @foreach ($post->tags as $tag)
                                                <input type="checkbox" wire:model="selected_tag" class="btn-check" id="btn-check-{{ "$post->id-$tag->id" }}" value="{{ $tag->id }}" autocomplete="off">
                                                <label class="mb-1 px-3 btn btn-outline-main-500 btn-sm" for="btn-check-{{ "$post->id-$tag->id" }}">
                                                    {{ $tag->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (!$loop->last)
                                <hr class="my-0">
                            @endif
                        @endforeach
                    @else
                        <div class="card-body">
                            <p class="card-text">
                                There is no articles.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
