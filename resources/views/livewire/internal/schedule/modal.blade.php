<form wire:submit.prevent="saveEvent" method="post">
    <div class="modal fade" id="add-event-modal" tabindex="-1"
        x-data="{
            mouse: { x: 0, y: 0 },
            isAllday: true,
            modalStyle: @entangle('modal_window'),
            isCollapsed: false,
        }"
        x-bind:style="{ display: modalStyle.show ? 'block' : 'none' }"
        :class="modalStyle.show ? 'show' : ''">

        <div class="modal-dialog m-0 modal-fullscreen-md-down shadow"
            x-ref="modalEl"
            x-bind:style="modalStyle">

            <div class="modal-content bg-800">
                <div class="modal-header" draggable="true"
                    x-on:dragstart="
                    mouse.x = $refs.modalEl.offsetLeft - event.pageX;
                    mouse.y = $refs.modalEl.offsetTop - event.pageY;
                    event.dataTransfer.setDragImage(document.createElement('div'), 0, 0);
                "
                    x-on:drag="
                    if (!event.x && !event.y) return;
                    $refs.modalEl.style.setProperty('left', event.pageX + mouse.x + 'px');
                    $refs.modalEl.style.setProperty('top', event.pageY + mouse.y + 'px');
                "
                    x-on:dragend="
                        $wire.set('modal_window.left', event.pageX + mouse.x + 'px');
                        $wire.set('modal_window.top', event.pageY + mouse.y + 'px');
                        mouse.x = mouse.y = 0;">

                    <h5 class="modal-title">
                        {{ $modal_window['title'] }} Event
                    </h5>
                    <span>
                        <button type="button" class="btn btn-link p-0 me-2 text-white fs-5" x-on:click="isCollapsed = !isCollapsed">
                            <i class="bi bi-dash"></i>
                        </button>
                        <button type="button" class="btn btn-link p-0 text-white fs-5" wire:click="closeModal">
                            <i class="bi bi-x"></i>
                        </button>
                    </span>
                </div>
                <div class="modal-body" x-show="!isCollapsed" x-transition>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input wire:model.lazy="event.title" type="text" class="form-control border-700 text-bg-700 @error('event.title') is-invalid @enderror" placeholder="Tokyo, Japan" autocomplete="state">
                                <label for="floatingInput">
                                    Title
                                </label>
                                @error('event.title')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3 d-flex justify-content-end">
                            <div class="form-check form-switch">
                                <input wire:model="event.all_day" class="form-check-input" type="checkbox" role="switch" id="check-allday">
                                <label class="form-check-label" for="check-allday">
                                    allDay
                                </label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="date" class="form-control border-700 text-bg-700 @error('event.start') is-invalid @enderror" wire:model.lazy="event.start">
                            @error('event.start')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <input type="date" class="form-control border-700 text-bg-700 @error('event.end') is-invalid @enderror" wire:model.lazy="event.end">
                            @error('event.end')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3" x-show="!$wire.event.all_day">
                            <input wire:model.lazy="event.start_time" type="time" class="form-control border-700 text-bg-700 @error('event.start_time') is-invalid @enderror">
                            @error('event.start_time')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3" x-show="!$wire.event.all_day">
                            <input wire:model.lazy="event.end_time" type="time" class="form-control border-700 text-bg-700 @error('event.end_time') is-invalid @enderror">
                            @error('event.end_time')
                                <div class="invalid-feedback text-left">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input wire:model.lazy="event.location" type="text" class="form-control border-700 text-bg-700 @error('event.location') is-invalid @enderror" placeholder="Tokyo, Japan" autocomplete="state">
                                <label for="floatingInput">
                                    Location
                                </label>
                                @error('event.location')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input wire:model.lazy="event.url" type="text" class="form-control border-700 text-bg-700 @error('event.url') is-invalid @enderror" placeholder="www.google.com" autocomplete="url">
                                <label for="floatingInput">
                                    URL
                                </label>
                                @error('event.url')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea wire:model.lazy="event.description" type="text" class="form-control border-700 text-bg-700 @error('event.description') is-invalid @enderror" placeholder="hello" autocomplete="description" style="height:10rem"></textarea>
                                <label for="floatingInput">
                                    description
                                </label>
                                @error('event.description')
                                    <div class="invalid-feedback text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if ($modal_window['title'] === 'Edit')
                        <button type="button" class="btn btn-outline-danger ms-0 me-auto" wire:click="deleteEvent()">
                            Delete
                        </button>
                    @endif
                    <button type="button" class="btn btn-outline-500" wire:click="closeModal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-main-500">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
