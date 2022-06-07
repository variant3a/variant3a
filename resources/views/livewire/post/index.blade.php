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
                                <input wire:model="keyword" type="text" class="form-control border-700 text-bg-700" placeholder="Keywords">
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
                                <div class="row">

                                </div>
                                <div class="row">

                                </div>
                                <div class="row">

                                </div>
                                <p class="card-text">
                                    {!! $post->content !!}
                                </p>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $post->created_at }}
                                </h6>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $post->updated_at }}
                                </h6>
                            </div>
                            @if (!$loop->last)
                                <hr>
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
