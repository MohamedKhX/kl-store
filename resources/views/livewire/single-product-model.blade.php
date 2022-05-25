<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="singleProductLabel">A product</h5>
        <button wire:click="unShowProduct" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div>
            <livewire:product :identifier="1" :color-id="1" />
        </div>
    </div>
    <div class="modal-footer">
        <button x-data="{open: {{ $collectionModel }}}" x-show="open" wire:click="unShowProduct"
                class="btn btn-primary"
                data-bs-target="#CollectionModel"
                data-bs-toggle="modal"
                data-bs-dismiss="modal">
            Back to first
        </button>

        <button wire:click="unShowProduct"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
            Close window
        </button>
    </div>
</div>
