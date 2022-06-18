<x-layout.Dashboard.main>
    <div class="container d-flex flex-column align-items-center justify-content-center">
        @if(session()->has('success'))
            <div class="alert alert-success mt-4">
                <span class="text-white">
                    {{ session()->get('success') }}
                </span>
            </div>
        @endif
        <div class="card w-100 w-md-75 w-lg-50 my-5">
            <div class="card-body text-center mt-4">
                <h5 class="font-weight-normal mt-2">

                </h5>
                <div class="mt-3">
                    <div>
                        <h6>
                            <strong class="">Requested At :</strong>
                            <span class="text-primary">{{ $order->created_at }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div>
                        <h6>
                            <strong class="">Name :</strong>
                            <span class="text-primary">{{ $order->name }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div>
                        <h6>
                            <strong class="">Phone Number :</strong>
                            <span class="text-primary">{{ $order->phone_number }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div>
                        <h6>
                            <strong class="">Total Products</strong>
                            <span class="text-primary">{{ $order->totalProducts() }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div>
                        <h6>
                            <strong class="">Total Quantity</strong>
                            <span class="text-primary">{{ $order->totalQuantity() }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div class="px-6">
                        <h6>
                            <strong class="ms-auto">Price : </strong>
                            <span class="text-primary">{{ $order->priceWithOutShipping() }} LYD</span>
                        </h6>
                        <hr>
                    </div>

                    @if($order->options)
                        <div class="px-6">
                            <h6>
                                <strong class="ms-auto">Discount : </strong>
                                <span class="text-primary">{{ $order->options->discount }} LYD</span>
                            </h6>
                            <hr>
                        </div>
                        <div class="px-6">
                            <h6>
                                <strong class="ms-auto">Price after discount : </strong>
                                <span class="text-primary">{{ $order->options->newSubTotal }} LYD</span>
                            </h6>
                            <hr>
                        </div>
                    @endif

                    <div class="px-6">
                        <h6>
                            <strong class="ms-auto">Shipping Price :</strong>
                            <span class="text-primary">{{ $order->shippingPrice() }} LYD</span>
                        </h6>
                        <hr>
                    </div>
                    <div class="px-6">
                        <strong class="text-dark">User Notes :</strong>
                        <p>
                            {{ $order->notes }}
                        </p>
                        <hr>
                    </div>
                    <div class="px-6">
                        <h6>
                            <strong class="ms-auto">Status : </strong>
                            <span class="text-danger">{{ $order->status }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div class="px-6">
                        <form method="POST" action="{{ route('admin.orders.fast-update', $order) }}">
                            @csrf
                            @method('PATCH')

                            <div class="input-group input-group-static mb-4 d-flex flex-column align-items-center justify-content-center">
                                <label for="status" class="text-center">
                                    Status
                                </label>
                                <select name="status" class="form-control text-center" id="status">
                                    <option value="Requested"
                                        {{ $order->status == 'Requested' ? 'selected' : null }}
                                    >
                                        Requested
                                    </option>
                                    <option value="Accepted"
                                        {{ $order->status == 'Accepted' ? 'selected' : null }}
                                    >
                                        Accepted
                                    </option>
                                    <option value="Refused"
                                        {{ $order->status == 'Refused' ? 'selected' : null }}
                                    >
                                        Refused
                                    </option>
                                    <option value="InComing"
                                        {{ $order->status == 'InComing' ? 'selected' : null }}
                                    >
                                        InComing
                                    </option>
                                    <option value="InLibya"
                                        {{ $order->status == 'InLibya' ? 'selected' : null }}
                                    >
                                        InLibya
                                    </option>
                                    <option value="Arrived"
                                        {{ $order->status == 'Arrived' ? 'selected' : null }}
                                    >
                                        Arrived
                                    </option>
                                    <option value="No Response"
                                        {{ $order->status == 'No Response' ? 'selected' : null }}
                                    >
                                        No Response
                                    </option>
                                    <option value="Not Accepted"
                                        {{ $order->status == 'Not Accepted' ? 'selected' : null }}
                                    >
                                        Not Accepted
                                    </option>
                                </select>
                            </div>
                            <div>
                                <p class="bold text-info"><strong>Write your notes here</strong></p>
                                <div class="input-group input-group-dynamic my-3">
                                <textarea class="form-control"
                                          rows="2"
                                          placeholder="Write your notes about the order here"
                                          spellcheck="false"
                                          name="admin_notes"
                                >{{ old('admin_notes') ?? $order->admin_notes }}</textarea>
                                </div>
                            </div>

                            <input class="btn btn-dark" type="submit" value="Save">
                        </form>
                        <hr>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-3 mx-auto">
                    <a class="d-flex justify-content-center align-items-center text-center btn btn-link text-info border-0"
                       href="#"
                    >
                        <i class="material-icons text-lg">edit</i>
                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer d-flex justify-content-between">
                <p class="font-weight-normal my-auto">
                    Price : {{ $order->priceWithOutShipping() }} LYD
                </p>
                <p class="font-weight-normal my-auto">
                    City : {{ $order->city->name }}
                </p>
            </div>
        </div>
        <div class="">
            @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-4 mt-5">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ $product['colorProduct']->images[0] }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                        </div>
                        <div class="card-body text-center mt-6">
                            <div class="d-flex justify-content-center mt-n6 mx-auto">
                            </div>
                            <div>
                                <h5 class="font-weight-normal mt-0">
                                    <a href="javascript:;">{{ $product['colorProduct']->product->name }}</a>
                                </h5>
                                <hr>
                            </div>

                            @if($product['colorProduct']->url)
                                <div>
                                    <h6 class="font-weight-normal mt-0">
                                        <a href="{{ $product['colorProduct']->url }}">
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

                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between">
                            <p class="font-weight-normal my-auto"><strong>{{ $product['colorProduct']->price }}</strong></p>
                            <p class="font-weight-normal my-auto">
                                <strong>Size:</strong>
                                <span class="text-primary">
                                    {{ $product['options']['size'] }}
                                </span>
                            </p>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
    </div>
</x-layout.Dashboard.main>
