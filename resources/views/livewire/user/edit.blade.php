<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="card-title fs-3 text-center">
                    Edit Profile
                </div>
                <div class="card-text text-end">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="w-50 position-relative" style="height:0;padding-top:50%">
                                <img src="{{ asset("storage/$user->profile_photo_path") }}" class="w-100 h-100 fixed-top position-absolute rounded-4" style="object-fit:cover;z-index:auto">
                            </div>
                        </div>
                        <div class="row mb-3"
                            x-data="{ droping: false, progress: 0 }"
                            x-cloak>

                            <div class="col-12 d-grid gap-2"
                                x-on:livewire-upload-finish="droping = false;progress = 0"
                                x-on:livewire-upload-error="droping = false;progress = 0"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <label class="btn btn-outline-main-500 px-3 py-2 d-hidden"
                                    x-show="!progress"
                                    x-bind:style="{ 'border-style': droping ? 'dashed' : 'solid' }">

                                    <input type="file" wire:model="file" class="d-none" accept="image/*">
                                    Upload Image
                                </label>
                                <div x-show="progress">
                                    <div class="progress border border-1 border-main-500 text-main-500 bg-transparent fs-6" style="height:unset">
                                        <div class="progress-bar px-3 py-2 progress-bar-striped progress-bar-animated bg-main-500"
                                            x-bind:style="{ width: `${progress}%` }">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <form wire:submit.prevent="update" method="POST">
            <div class="card text-bg-800">
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <input wire:model="user.user_id" type="text" class="form-control border-700 text-bg-800" placeholder="johndoe" autocomplete="" disabled>
                        <label for="floatingInput">
                            ID
                        </label>
                        @error('user.name')
                            <div class="invalid-feedback text-left">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input wire:model="user.name" type="text" class="form-control border-700 text-bg-700 @error('user.name') is-invalid @enderror" placeholder="John Doe" autocomplete="name">
                        <label for="floatingInput">
                            Name
                        </label>
                        @error('user.name')
                            <div class="invalid-feedback text-left">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-block btn-main-500">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 mb-3">
        <div class="card text-bg-800">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 overflow-auto" style="max-height:50vh">
                        @if ($timelines->count())
                            @foreach ($timelines as $item)
                                <div class="timeline-item">
                                    <div class="py-2 d-flex align-items-center">
                                        <i class="px-1 fs-4 bi {{ ($item->icon ?? 'bi-circle') . ' text-' . ($item->icon_color ?? '') }}"></i>
                                        <span class="px-2 text-muted" title="{{ $item->start_date->format('Y-m-d H:i:s') . ' - ' . $item->end_date?->format('Y-m-d H:i:s') ?? '' }}">
                                            {{ $item->start_date->format('F, Y') }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mx-3 border-1 border-start {{ 'border-' . ($item->icon_color ?? '') }}"></div>
                                        <div class="ms-2 my-3 flex-grow-1 d-grid gap-2">
                                            <input type="radio" wire:model="selected_timeline" class="btn-check" id="timeline-check-{{ $item->id }}" value="{{ $item->id }}" autocomplete="off">
                                            <label for="timeline-check-{{ $item->id }}" class="btn btn-outline-main-500 p-0" wire:click="addTimeline({{ $item->id }})">
                                                <div class="card-body text-start text-break">
                                                    <span class="text-break">
                                                        {{ $item->title }}
                                                    </span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-muted">
                                No Timelines.
                            </div>
                        @endif
                        <div class="timeline-item mb-3">
                            <button class="btn btn-link p-0 py-2 d-flex align-items-center" wire:click="clearTimeline()">
                                <i class="px-1 fs-4 bi bi-plus"></i>
                                <span class="px-2">
                                    Add Timeline
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row mb-3">
                            <div class="col-auto">
                                <input wire:model.debounce.500ms="timeline.start_date" class="form-control text-bg-700 @error('timeline.start_date') is-invalid @enderror" type="month">
                                @error('timeline.start_date')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                -
                            </div>
                            <div class="col-auto">
                                <input wire:model.debounce.500ms="timeline.end_date" class="form-control text-bg-700 @error('timeline.end_date') is-invalid @enderror" type="month">
                                @error('timeline.end_date')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($selected_timeline)
                                <div class="col-auto ms-auto">
                                    <a href="" class="py-3 border-left rounded-0 text-500" style="width:5rem" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end position-absolute">
                                        <li>
                                            <form wire:submit.prevent="deleteTimeline" method="POST">
                                                <button type="submit"class="dropdown-item text-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <i class="ps-3 fs-4 bi {{ ($timeline->icon ?? 'bi-circle') . ' text-' . ($timeline->icon_color ?? '') }}"></i>
                            </div>
                            <div class="col-auto">
                                <input wire:model.debounce.500ms="timeline.icon" type="text" class="form-control border-700 text-bg-700 @error('timeline.icon') is-invalid @enderror" placeholder="bi-circle">
                                @error('timeline.icon')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-auto me-auto">
                                <input wire:model.debounce.500ms="timeline.icon_color" type="text" class="form-control border-700 text-bg-700 @error('icon.{{ $loop->index }}') is-invalid @enderror" placeholder="color">
                                @error('timeline.icon_color')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="text" wire:model.debounce.500ms="timeline.title" class="form-control border-700 text-bg-700 @error('timeline.title') is-invalid @enderror" placeholder="Title">
                                @error('timeline.title')
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
                                        <textarea wire:model.debounce.500ms="timeline.content" class="form-control p-3 border-0 text-bg-700 rounded-0 rounded-bottom shadow-none @error('timeline.content') is-invalid @enderror" placeholder="Content" rows="5"></textarea>
                                        @error('timeline.content')
                                            <div class="invalid-feedback text-left">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                                        <div class="p-3 border-700 text-bg-700 rounded-0 rounded-bottom shadow-none">
                                            @if ($timeline['content'] ?? false)
                                                <div class="markdown lh-lg">
                                                    {!! e(App\Services\MarkdownService::parse($timeline['content'])) !!}
                                                </div>
                                            @else
                                                <span class="text-muted">
                                                    no preview.
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card text-bg-700">
                                    <div class="card-body">
                                        <form wire:submit.prevent="createTag" method="post">
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input type="text" wire:model.debounce.500ms="new_tag" class="form-control border-700 text-bg-600" placeholder="Tag name">
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
                            <div class="col-md-6 mb-3">
                                <div class="card text-bg-700">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-12 d-flex">
                                                <input type="text" wire:model="filter_tag" class="form-control border-600 text-bg-600" placeholder="Filter">
                                                <button class="btn btn-600 ms-2" wire:click="sortTag">
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
                                                    <div class="text-muted">
                                                        no tags.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
