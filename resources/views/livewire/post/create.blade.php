<div class="row">
    <div class="col-md-3 col-12">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card text-bg-800">
                    <div class="card-body">
                        <form wire:submit.prevent="createTag" method="post">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="text" wire:model="new_tag" class="form-control border-700 text-bg-700" placeholder="Tag name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-outline-main-500">
                                        Add Tag
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card text-bg-800">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 d-flex">
                                <input type="text" wire:model="filter_tag" class="form-control border-700 text-bg-700" placeholder="Filter">
                                <button class="btn btn-700 ms-2" wire:click="sortTag">
                                    @if ($sort_tag)
                                        <i class="bi bi-sort-alpha-up"></i>
                                    @else
                                        <i class="bi bi-sort-alpha-down"></i>
                                    @endif
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                @if ($tags->count())
                                    @foreach ($tags as $tag)
                                        <input type="checkbox" wire:model="selected_tag" class="btn-check" id="btn-check-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off">
                                        <label class="mb-1 px-3 btn btn-outline-main-500 btn-sm" for="btn-check-{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </label>
                                    @endforeach
                                @else
                                    <div class="text-500">
                                        no tags.
                                    </div>
                                @endif
                                @error('post.title')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-12">
        <div class="card text-bg-800">
            <div class="card-body">
                <form wire:submit.prevent="store" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="text" wire:model="post.title" class="form-control border-700 text-bg-700 @error('post.title') is-invalid @enderror" placeholder="Title">
                            @error('post.title')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link text-bg-hover-main-500 active" id="editor-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                        Editor
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link text-bg-hover-main-500" id="preview-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                        Preview
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="editor-tab" tabindex="0">
                                    <textarea wire:model="post.content" class="form-control p-3 border-700 text-bg-700 rounded-0 rounded-bottom shadow-none @error('post.content') is-invalid @enderror" rows="10" placeholder="Content"></textarea>
                                    @error('post.content')
                                        <div class="invalid-feedback text-left">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                                    <div class="p-3 border-700 text-bg-700 rounded-0 rounded-bottom shadow-none">
                                        @if ($post['content'] ?? false)
                                            {!! e(Illuminate\Mail\Markdown::parse($post['content'])) !!}
                                        @else
                                            <span class="text-500">
                                                no preview.
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-outline-red-600">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-main-500">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
