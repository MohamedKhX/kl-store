<div>
    <div class="container mt-5">
        <div class="row">

            <div class="d-none d-lg-block col-8">
                @if(count($cartItems) <= 0)
                    <h3 class="p-7 text-center">No Products in the cart!</h3>
                @else
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th class="p-4" scope="col">COLOR</th>
                            <th class="p-4" scope="col">PRODUCT</th>
                            <th class="p-4" scope="col">SIZE</th>
                            <th class="p-4" scope="col">PRICE</th>
                            <th class="p-4" scope="col">QUANTITY</th>
                            <th class="p-4" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <livewire:cart-item :row-id="$item->rowId" />
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="col-12 my-3 d-lg-none">
                <div class="d-flex flex-column justify-content-center">
                    @if(count($cartItems) <= 0)
                        <h3 class="p-3 text-center">No Products in the cart!</h3>
                    @else
                        @foreach($cartItems as $item)
                            <livewire:cart-item :type="'card'" :row-id="$item->rowId" />
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-12 d-lg-none">
                @if(count($cartItems) === 0)
                @else
                    <form action="">
                        <div class="mb-3">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Coupon code"
                                   style="padding: .5rem 1rem"
                            >
                            <button class="btn btn-dark px-2 mt-3 w-100" type="button">APPLY COUPON</button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="col-12 col-lg-4">
                <div class="mt-7">
                    <h4>Cart Totals</h4>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Subtotal</h5>
                        <h5><strong>{{ $subTotal }} LYD</strong></h5>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Shipping to Bangazi</h5>
                        <h5><strong>30 LYD</strong></h5>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5><strong>{{ $total }} LYD</strong></h5>
                    </div>
                    <hr>
                    <button class="btn btn-dark w-100" {{ count($cartItems) === 0 ? 'disabled' : null }}>PROCEED TO CHECK OUT</button>
                </div>
            </div>

            <div class="col-4 d-none d-lg-block">
                <h4>Have a coupon?</h4>
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               placeholder="Coupon code"
                        >
                        <button class="btn btn-dark px-2" type="button">APPLY COUPON</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

