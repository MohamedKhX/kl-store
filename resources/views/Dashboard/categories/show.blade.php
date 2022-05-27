<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="mt-5">
                    @foreach($category->products as $product)
                        <div class="card my-5">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <a class="d-block blur-shadow-image" href="">
                                    <img src="{{ $product->thumbnail }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                </a>
                                <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                            </div>
                            <div class="card-body text-center mt-5">
                                <div class="d-flex mt-n6 mx-auto">
                                    <a class="btn btn-link text-primary ms-auto border-0"
                                       onclick=""
                                       data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                    >
                                        <i class="material-icons text-lg">delete</i>
                                    </a>
                                    <a class="btn btn-link text-info me-auto border-0"
                                       href=""
                                    >
                                        <i class="material-icons text-lg">edit</i>
                                    </a>
                                </div>
                                <h5 class="font-weight-normal mt-3">
                                    <a href="">{{ $product->name }}</a>
                                </h5>
                                <p class="mb-0">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer d-flex justify-content-between">
                                <p class="font-weight-normal my-auto">Price :
                                    <span class="badge bg-gradient-danger">{{ $product->price() }}</span>
                                </p>
                                <p class="font-weight-normal my-auto">Views : {{$product->views}}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
