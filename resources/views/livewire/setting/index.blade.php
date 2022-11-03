<div class="flex flex-col p-2 mb-1 bg-white rounded shadow sm:mb-3 sm:p-3 h-fit dark:bg-zinc-700 text-neutral-700 dark:text-neutral-200 ring-1 ring-black/5">
    <form wire:submit.prevent="createTag" method="post">
        <div class="flex mb-1 sm:mb-3">
            <input wire:model="new_tag" type="text"
                class="w-full p-2 mr-2 bg-white rounded sm:mr-3 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0" placeholder="New tag">
            <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5">
                Add
            </button>
        </div>
    </form>
    @if ($tags->count())
        <div class="col-span-1 md:col-span-1 mb-1 sm:mb-3 overflow-auto max-h-[50vh]">
            <ul class="mx-1 my-1 list-group sm:my-3">
                @foreach ($tags as $tag)
                    <div class="flex mb-3">
                        <input wire:model="selected_tag" class="hidden peer" type="checkbox" value="{{ $tag->id }}" id="{{ "tag-$tag->id" }}" autocomplete="off" @disabled($tag->posts->count()) @disabled($tag->timelines->count())>
                        <label class="px-4 py-3 bg-white border-r rounded-l w-fit text-neutral-700 peer-disabled:text-neutral-200 dark:text-neutral-200 dark:peer-disabled:text-neutral-400 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0 peer-checked:bg-teal-500 peer-checked:text-neutral-200 border-neutral-200 dark:border-neutral-700" for="{{ "tag-$tag->id" }}">
                            <i class="bi bi-check-lg"></i>
                        </label>
                        <input wire:model="{{ "tags.$loop->index.name" }}" type="text" class="w-full p-2 bg-white rounded-r sm:mr-3 dark:bg-zinc-600 ring-1 ring-black/10 dark:ring-0 focus:ring-2 dark:focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-500 focus:outline-0">
                    </div>
                @endforeach
            </ul>
        </div>
    @else
        <span class="px-4 text-neutral-400">
            No tags.
        </span>
    @endif
    <div class="">
        <span class="text-neutral-400">
            {{ count($selected_tag) }} items selected.
        </span>
        <div class="flex justify-between">
            <form wire:submit.prevent="deleteTag" method="post">
                <button type="submit" class="px-4 py-2 font-bold text-center bg-red-500 rounded shadow hover:shadow-lg dark:hover:bg-red-400/90 text-neutral-200 ring-1 ring-black/5" @disabled(count($selected_tag) === 0)>
                    Delete
                </button>
            </form>
            <form wire:submit.prevent="updateTag" method="post">
                <button type="submit" class="inline-block px-4 py-2 font-bold text-center bg-teal-500 rounded shadow hover:shadow-lg dark:hover:bg-teal-400/90 text-neutral-200 ring-1 ring-black/5" @disabled(count($selected_tag) === 0)>
                    Save
                </button>
            </form>
        </div>
    </div>
</div>
