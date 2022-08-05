<div class="col-12 col-md-6 col-lg-4 mt-5">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <a class="d-block blur-shadow-image">
                <img src="{{ $product['thumbnail'] }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
            </a>
            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
        </div>
        <div class="card-body text-center mt-6">
            <div class="d-flex justify-content-center mt-n6 mx-auto">
            </div>
            <div>
                <h5 class="font-weight-normal mt-0">
                    <a href="javascript:;">{{ $product['name'] }}</a>
                    {{ $product['rowId'] }}
                </h5>
                <hr>
            </div>

            @if($product['options']['product_url'])
                <div>
                    <h6 class="font-weight-normal mt-0">
                        <a href="{{ $product['options']['product_url'] }}">
                            <strong>
                                Product Url:
                            </strong>
                            <span class="text-primary">
                                Click
                            </span>
                        </a>
                    </h6>
                    <hr>
                </div>
            @endif

            <div>
                <h6 class="font-weight-normal mt-0">
                    <a href="">
                        <strong>
                            Quantity:
                        </strong>
                        <span class="text-primary">
                            {{ $product['qty'] }}
                        </span>
                    </a>
                </h6>
                <hr>
            </div>
            <div x-data="{editMode: false}">
                <button @click="editMode = !editMode" class="btn btn-info fw-bold">
                    <span x-text="editMode ? 'Collapse' : 'Edit' "></span>
                </button>
                <div x-show="editMode" class="container">
                    @if(session()->has('success'))
                        <strong class="text-primary">Saved Successfully</strong>
                    @endif
                    <form wire:submit.prevent="handleUpdate">
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="product_size-{{ $product['options']['product_id'] }}" class="form-label">Size</label>
                            <input wire:model.defer="size" id="product_size-{{ $product['options']['product_id'] }}" name="product_size-{{ $product['options']['product_id'] }}" type="text" class="form-control" value="{{ $product['options']['size'] }}">
                        </div>
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="product_quantity-{{ $product['options']['product_id'] }}" class="form-label">Quantity</label>
                            <input wire:model.defer="quantity" id="product_quantity-{{ $product['options']['product_id'] }}" name="product_quantity-{{ $product['options']['product_id'] }}" type="text" class="form-control" value="{{ $product['qty'] }}">
                        </div>
                        <input type="submit" class="btn btn-success" value="update">
                    </form>
                </div>

            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer d-flex justify-content-between">
            <p class="font-weight-normal my-auto"><strong>{{ $product['price'] }} LYD</strong></p>
            <p class="font-weight-normal my-auto">
                <strong>Size:</strong>
                <span class="text-primary">
                                    {{ $product['options']['size'] }}
                                </span>
            </p>
        </div>
    </div>
</div>
