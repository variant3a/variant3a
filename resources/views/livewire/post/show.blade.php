<div class="mb-4">
    <div class="card bg-800">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h5 class="ps-2 py-2 border-start border-4 border-main-500 text-break">
                        {{ $post->title }}
                    </h5>
                    @auth
                        <span>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn text-bg-hover-main-500 border-0 text-nowrap">
                                Edit
                                <i class="bi bi-pen-fill"></i>
                            </a>
                        </span>
                    @endauth
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
            <div class="row mb-3">
                <div class="col-12 markdown">
                    {!! e(App\Services\MarkdownService::parse($post->content)) !!}
                </div>
            </div>
            @if ($post->tags->count())
                <div class="row">
                    <div class="col-12 text-500">
                        @foreach ($post->tags as $tag)
                            <span class="mb-1 me-1 py-1 px-3 border border-main-500 small text-main-500 rounded-1">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
