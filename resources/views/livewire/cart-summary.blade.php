<div class="col-12 col-xl-12 col-xxl-4 d-flex flex-column align-items-center">
    {{-- Start Coupon Section --}}
    <div class="col-12 col-xl-6 col-xxl-12 mt-7">

        @if(session()->has('couponError'))
            <div class="alert alert-danger d-flex justify-content-between {{arRight()}}" role="alert">
                @if(ar())
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <span class="">
                               {{ session()->get('couponError') }}
                            </span>
                @else
                    <span class="">
                               {{ session()->get('couponError') }}
                            </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
            </div>
        @endif
        @if(session()->has('couponSuccess'))
            <div class="alert alert-success d-flex justify-content-between {{arRight()}}" role="alert">
                @if(ar())
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <span class="">
                               {{ session()->get('couponSuccess') }}
                            </span>
                @else
                    <span class="">
                               {{ session()->get('couponSuccess') }}
                            </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
            </div>
        @endif

        @if(count($cartItems) === 0)
        @else
            @if(! $discount)
                <form wire:submit.prevent="applyCoupon">
                    <div class="mb-3" x-data="{couponCode: ''}">
                        <input type="text"
                               class="form-control {{arRight()}}"
                               placeholder="{{ __('cart.coupon_code')  }}"
                               style="padding: .5rem 1rem"
                               wire:model.defer="couponCode"
                               x-model="couponCode"

                        >
                        <button
                            class="btn btn-dark px-2 mt-3 w-100"
                            type="submit"
                            :disabled="couponCode.length < 1"
                        >
                            {{ __('cart.apply_coupon') }}
                        </button>
                    </div>
                </form>
            @endif
        @endif
    </div>
    {{-- End Coupon Section --}}

    {{-- Start Cart Summary --}}
    <div class="col-12 col-xl-6 col-xxl-12">
        <div class="mt-7">
            <h4 class="{{ arRight() }}">{{ __('cart.cart_totals') }}</h4>
            <hr>
            <div class="d-flex justify-content-between">
                @if(ar())
                    <h5><strong> {{ __('elements.LYD') . '‎' }} {{ $subTotal }}</strong></h5>
                    <h5>{{ __('cart.sub_total') }}</h5>
                @else
                    <h5>{{ __('cart.sub_total') }}</h5>
                    <h5><strong>{{ $subTotal }} {{ __('elements.LYD') }}</strong></h5>
                @endif
            </div>
            <hr>

            @if($discount)
                <div class="d-flex justify-content-between">
                    @if(ar())
                        <h5>
                            <strong>
                                {{ __('elements.LYD') . '‎' }}
                                -{{ $discount }}
                            </strong>
                        </h5>
                        <h5>{{ __('cart.discount') }}
                            <a class="ms-4" href="#" wire:click="deleteCoupon">
                                <strong class="text-danger">إلغاء الخصم</strong>
                            </a>
                        </h5>
                    @else
                        <h5>{{ __('cart.discount') }}</h5>
                        <h5><strong>-{{ $discount }} {{ __('elements.LYD') }}</strong></h5>
                    @endif
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    @if(ar())
                        <h5><strong> {{ __('elements.LYD') . '‎' }} {{ $newSubTotal }}</strong></h5>
                        <h5>{{ __('cart.new_subtotal') }}</h5>
                    @else
                        <h5>{{ __('cart.new_subtotal') }}</h5>
                        <h5><strong>{{ $newSubTotal }} {{ __('elements.LYD') }}</strong></h5>
                    @endif
                </div>
                <hr>
            @endif


            <div class="d-flex justify-content-between">
                @if(ar())
                    <h5><strong> {{  __('elements.LYD') . '‎' }} 30</strong></h5>
                    <h5>{{ __('cart.shipping_to') }} بنغازي </h5>
                @else
                    <h5>{{ __('cart.shipping_to') }} Bangazi</h5>
                    <h5><strong>30 {{ __('elements.LYD') }}</strong></h5>
                @endif
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                @if(ar())
                    <h5><strong>{{ __('elements.LYD') . '‎' }} {{ $total }} </strong></h5>
                    <h5>{{ __('cart.total') }}</h5>
                @else
                    <h5>{{ __('cart.total') }}</h5>
                    <h5><strong>{{ $total }} {{ __('elements.LYD') }}</strong></h5>
                @endif
            </div>
            <hr>
            <a href="{{ route('order.index') }}"
               class="btn btn-dark w-100" {{ count($cartItems) === 0 ? 'disabled' : null }}
            >
                {{ __('cart.proceed_to_checkout') }}
            </a>
        </div>
    </div>
    {{-- End Cart Summary --}}
</div>
