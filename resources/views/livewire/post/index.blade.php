<div class="row">
    <div class="col-md-3">
        <div class="row mb-3">
            <div class="col-12 d-grid gap-2">
                <a href="{{ route('post.create') }}" class="btn btn-main-500">
                    Create
                </a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 d-grid gap-2">
                <div class="card text-bg-800">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" wire:model="keyword" class="form-control border-700 text-bg-700" placeholder="Keywords">
                            </div>
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
                                    <div class="col-12">
                                        <h5 class="card-title">
                                            {{ $post->title }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 text-500">
                                        {{ $post->user->name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        {!! Illuminate\Mail\Markdown::parse(e($post->content)) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ $post->created_at->format('Y-m-d H:i') }}
                                        </h6>
                                    </div>
                                </div>
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
