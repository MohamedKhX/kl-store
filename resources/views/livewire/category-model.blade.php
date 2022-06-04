<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="CategoryModelLabel">A category</h5>
        <button wire:click="unShowCategory" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <livewire:category />
    </div>
    <div class="modal-footer">
        <button wire:click="unShowCategory" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close window</button>
    </div>
</div>


