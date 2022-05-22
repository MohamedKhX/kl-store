<x-layout.main>
     <main class="main" id="top">

        {{-- Start Header-Section --}}
            @include('homeLayout._header')
        {{-- End Header-Section --}}

        {{-- Start Best-deals-section --}}
        <section class="py-0">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mt-7 mb-5">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Best Deals</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselBestDeals" data-bs-touch="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                <x-card.careousel-product class="active" data-bs-interval="10000">
                                    @foreach($bestDealsCollection->products as $product)
                                        <x-card.product :name="$product->name" :img="$product->thumbnail" :price="$product->price() . '$'" oldPrice="50$" />
                                    @endforeach
                                </x-card.careousel-product>

                                @if($bestDealsCollection->products->count() >= 5)
                                <x-card.careousel-product data-bs-interval="50300">
                                    @foreach($bestDealsCollection->products as $product)
                                        <x-card.product :name="$product->name" :img="$product->thumbnail" :price="$product->price() . '$'" oldPrice="50$" />
                                    @endforeach
                                </x-card.careousel-product>
                                @endif

                                @if($bestDealsCollection->products->count() >= 9)
                                <x-card.careousel-product data-bs-interval="3000">
                                    @foreach($bestDealsCollection->products as $product)
                                        <x-card.product :name="$product->name" :img="$product->thumbnail" :price="$product->price() . '$'" oldPrice="50$" />
                                    @endforeach
                                </x-card.careousel-product>
                                @endif

                                @if($bestDealsCollection->products->count() >= 13)
                                    <x-card.careousel-product>
                                        @foreach($bestDealsCollection->products as $product)
                                            <x-card.product :name="$product->name" :img="$product->thumbnail" :price="$product->price() . '$'" oldPrice="50$" />
                                        @endforeach
                                    </x-card.careousel-product>
                                @endif

                                @if($bestDealsCollection->products->count() >= 5)
                                    <div class="row d-none d-sm-block">
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBestDeals" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBestDeals" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5">
                        <a class="btn btn-lg btn-dark" href="#!">View All </a>
                    </div>
                </div>
            </div>
        </section>
        {{-- End Best-deals-section --}}

        {{-- Strat Exclusive collection Section --}}
        <section>
            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="text-800">{{ $exclusiveCollection->name }}</h4>
                            <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">{{ $exclusiveCollection->title }}</h1>
                            <p class="mb-5 fs-1">{{ $exclusiveCollection->description }}</p>
                            <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#" role="button">Explore</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <x-card.collection :name="$exclusiveCollection->name" :img="$exclusiveCollection->thumbnail"/>
                    </div>
                </div>
                <div class="row h-100 g-2 py-1 d-flex justify-content-center">
                    @foreach($collections->take(3) as $collection)
                        <div class="col-md-4">
                            <x-card.collection :name="$collection->name" :img="$collection->thumbnail" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- End Exclusive collection Section --}}

        {{-- Strat New Arraivels Section --}}
        <section class="py-0">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fs-3 fs-lg-5 lh-sm mb-3">Checkout New Arrivals</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselNewArrivals" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                                        @foreach($products->take(4) as $product)
                                            <x-card.rectangleProduct :name="$product->name" :price="$product->price()" :img="$product->thumbnail"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End New Arraivels Section --}}

        {{-- Strat Shop by category Section --}}
        <section>
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Shop By Category</h5>
                    </div>
                    <div class="col-12">
                        <nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
                                    <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men" role="tablist">
                                        @foreach($categories as $category)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{$loop->first ? 'active' : ''}}"
                                                        id="pills-{{$category->name}}-tab"
                                                        data-bs-toggle="pill"
                                                        data-bs-target="#pills-{{$category->name}}"
                                                        type="button" role="tab"
                                                        aria-controls="pills-{{$category->name}}"
                                                        aria-selected="true">
                                                    {{ $category->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                </ul>
                                    <div class="tab-content" id="pills-tabContentMen">
                                        @foreach($categories as $category)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                 id="pills-{{$category->name}}"
                                                 role="tabpanel"
                                                 aria-labelledby="pills-{{$category->name}}-tab">
                                                <div class="row h-100 align-items-center g-2">
                                                    @foreach($category->products->take(4) as $product)
                                                        <x-card.product :name="$product->name" :price="$product->price()" :img="$product->thumbnail"/>
                                                    @endforeach
                                                </div>
                                                <div class="col-12 d-flex justify-content-center mt-5">
                                                    <a class="btn btn-lg btn-dark" href="#">
                                                        View All
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                     </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        {{-- End Shop by category Section --}}

        {{-- Strat Best sellers Section --}}
        <section>
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Best Sellers</h5>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <x-card.product name="test" price="100" old-price="150"/>
                            <x-card.product name="test" price="100"/>
                            <x-card.product name="test" price="100"/>
                            <x-card.product name="test" price="100"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End Best sellers Section --}}

         {{-- Start Categories section --}}
        <section class="py-0" id="outlet">
            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="img/gallery/summer.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient rounded-0">
                                <div class="p-5 p-md-2 p-xl-5 d-flex flex-column flex-end-center align-items-baseline h-100">
                                    <h1 class="fs-md-4 fs-lg-7 text-light">Summer of '21 </h1>
                                </div>
                            </div><a class="stretched-link" href="#!"></a>
                        </div>
                    </div>
                    <div class="col-md-6 h-100">
                        <div class="row h-100 g-0">
                            @foreach($categories as $category)
                                <x-card.category :name="$category->name" :img="$category->thumbnail"/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        {{-- End Categories section --}}

        {{-- Start Collection --}}
        <section>
            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                            <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Gentle Formal Looks </h1>
                            <p class="mb-5 fs-1">We provide the top formal apparel package to make your job look confident and comfortable. Stay connect.</p>
                            <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#!" role="button">Explore Collection</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="img/gallery/sharp-dress.png" alt="..." /><a class="stretched-link" href="#!"></a></div>
                    </div>
                </div>
            </div>
        </section>
        {{-- End Collection --}}
    </main>
</x-layout.main>

