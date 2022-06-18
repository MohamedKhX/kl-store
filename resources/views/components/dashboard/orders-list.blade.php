@props(['OrderName', 'orders'])

<div class="mt-4">
    <h4 class="text-center">
        {{ $orderName }} Orders
    </h4>
    <div class="mt-4 d-flex flex-column align-items-center justify-content-center">
        @foreach($orders as $order)
            <div class="card w-100 w-md-75 w-lg-50 my-5">
                <div class="card-body text-center mt-4">
                    <h5 class="font-weight-normal mt-2">
                    </h5>
                    <div>
                        <h6>
                            <strong class="">Requested At :</strong>
                            <span class="text-primary">{{ $order->created_at }}</span>
                        </h6>
                        <hr>
                    </div>
                    <div class="mt-3">
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
                            <h6>
                                <strong class="ms-auto">Total Price : </strong>
                                <span class="text-primary">{{ $order->priceWithShipping() }} LYD</span>
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
                            <strong class="text-dark">Your Notes :</strong>
                            <p>
                                {{ $order->admin_notes }}
                            </p>
                            <hr>
                        </div>
                        <div>
                            <a class="btn btn-info" href="{{ route('admin.orders.show', $order) }}">Show Products</a>
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
        @endforeach
    </div>
</div>
