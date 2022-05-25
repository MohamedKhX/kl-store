<div class="modal fade" id="CollectionModel" tabindex="-1" aria-labelledby="CollectionModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CollectionModelLabel">A Collection</h5>
                <button wire:click="unShowCollection" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <livewire:collection />
            </div>
            <div class="modal-footer">
                <button wire:click="unShowCollection" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close window</button>
            </div>
        </div>
    </div>
</div>


