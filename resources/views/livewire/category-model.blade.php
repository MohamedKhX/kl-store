<div class="modal-content">
    <div class="py-3 px-3 d-flex justify-content-between">
        @if(ar())
            <button wire:click="unShowCategory" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="modal-title" id="CategoryModelLabel">{{ __('category.a_category') }}</h5>
        @else
            <h5 class="modal-title" id="CategoryModelLabel">{{ __('category.a_category') }}</h5>
            <button wire:click="unShowCategory" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        @endif
    </div>
    <div class="modal-body">
        <livewire:category />
    </div>
    <div class="modal-footer">
        <button wire:click="unShowCategory" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ __('elements.close_window') }}
        </button>
    </div>
</div>


