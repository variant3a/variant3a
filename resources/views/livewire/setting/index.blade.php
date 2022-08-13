<div class="row">
    <div class="col-md-6">
        <div class="card bg-800">
            <div class="card-body">
                <div class="card-title fs-3 text-center">
                    Manage Tags
                </div>
                <div class="card-text">
                    <form wire:submit.prevent="createTag" method="post">
                        <div class="d-flex">
                            <div class="mx-2 input-group">
                                <input wire:model="new_tag" type="text" class="form-control border-700 text-bg-700" placeholder="New tag">
                                <button type="submit" class="input-group-btn btn btn-outline-main-500 items-end">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                    @if ($tags->count())
                        <div class="my-2 overflow-auto" style="max-height:50vh">
                            <ul class="list-group m-2">
                                @foreach ($tags as $tag)
                                    <div class="input-group mb-3">
                                        <div class="input-group-text border-700 text-bg-700">
                                            <input wire:model="selected_tag" class="form-check-input mt-0" type="checkbox" value="{{ $tag->id }}" id="{{ "tag-$tag->id" }}" autocomplete="off" @disabled($tag->posts->count())>
                                        </div>
                                        <input wire:model="{{ "tags.$loop->index.name" }}" type="text" class="form-control border-700 text-bg-700">
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <span class="text-muted">
                            No tags.
                        </span>
                    @endif
                    <div class="mx-2 pb-2 d-flex align-items-center justify-content-between bg-800">
                        <span class="text-muted">
                            {{ count($selected_tag) }} items selected.
                        </span>
                        <div class="d-flex">
                            <form wire:submit.prevent="deleteTag" method="post">
                                <button type="submit" class="me-1 btn btn-outline-red-600" @disabled(count($selected_tag) === 0)>
                                    Delete
                                </button>
                            </form>
                            <form wire:submit.prevent="updateTag" method="post">
                                <button type="submit" class="btn btn-main-500" @disabled(count($selected_tag) === 0)>
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
