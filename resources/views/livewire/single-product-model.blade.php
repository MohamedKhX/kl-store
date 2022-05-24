<div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="singleProductLabel">A product</h5>
                <button wire:click="unShowProduct" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <livewire:product :identifier="1" :color-id="1" />
            </div>
            <div class="modal-footer">
                <button wire:click="unShowProduct" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close window</button>
            </div>
        </div>
    </div>
</div>


