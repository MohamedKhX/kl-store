<x-layout.Dashboard.main>
    <div class="container">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-simple" role="tab" aria-controls="profile" aria-selected="true">
                        All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-simple" role="tab" aria-controls="profile" aria-selected="true">
                        Requested
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        Refused
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        Accepted
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        InComing
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        InLibya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        Arrived
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        No Response
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        Not Accepted
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-simple" role="tab" aria-controls="dashboard" aria-selected="false">
                        Archived
                    </a>
                </li>
            </ul>
        </div>

        <div class="mt-4">
            <h4 class="text-center">
                Requested Orders
            </h4>
            <div class="mt-4">
                @foreach($orders as $order)
                    <div class="card my-5">
                        <div class="card-body text-center mt-4">
                            <h5 class="font-weight-normal mt-2">
                            </h5>
                            <div class="mt-3">
                                <h6>
                                    <a href="{{ route('admin.orders.show', $order) }}">
                                        {{ $order->name }}
                                    </a>
                                </h6>
                                <h6>
                                    {{ $order->phone_number }}
                                </h6>
                                <h6>Total Products : {{ $order->totalProducts() }}</h6>
                                <h6>Total Quantity : {{ $order->totalQuantity() }}</h6>
                                <h6>Total Price : {{ $order->priceWithShipping() }}</h6>
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
    </div>
</x-layout.Dashboard.main>
