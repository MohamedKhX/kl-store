<div class="modal fade" id="CartModel" tabindex="-1" aria-labelledby="CartModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="py-3 px-3 d-flex justify-content-between">
                @if(ar())
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="CartModelLabel">{{ __('cart.cart') }}</h5>
                @else
                    <h5 class="modal-title" id="CartModelLabel">{{ __('cart.cart') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
             </div>
            <div class="modal-body">
                <livewire:cart />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    {{ __('elements.close_window') }}
                </button>
            </div>
        </div>
    </div>
</div>
