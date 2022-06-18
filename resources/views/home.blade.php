<x-layout.main>
    <main class="main" id="top">

        {{-- Start Header-Section --}}
        @include('homeLayout._header')
        {{-- End Header-Section --}}

        {{-- Single Product Model --}}
        <div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                @if($products->count())
                    <livewire:single-product-model />
                @endif
            </div>
        </div>
        {{-- End Single Product Model --}}

        {{-- Start Collection Model --}}
        <div class="modal fade" id="CollectionModel" tabindex="-1" aria-labelledby="CollectionModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
               <livewire:collection-model />
            </div>
        </div>
        {{-- End Collection Model --}}

        {{-- Start Category Model --}}
        <div class="modal fade" id="CategoryModel" tabindex="-1" aria-labelledby="CategoryModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <livewire:category-model />
            </div>
        </div>
        {{-- End Category Model --}}

        {{-- Strat Shop by category Section --}}
        <section>
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ __('home.shop_by_category') }}</h5>
                    </div>
                    <div class="col-12">
                        <nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
                                    <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men" role="tablist">
                                        @foreach($categories as $category)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{$loop->first ? 'active' : ''}}"
                                                        id="pills-{{$category->slug}}-tab"
                                                        data-bs-toggle="pill"
                                                        data-bs-target="#pills-{{$category->slug}}"
                                                        type="button" role="tab"
                                                        aria-controls="pills-{{$category->slug}}"
                                                        aria-selected="true">
                                                    {{ $category->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="pills-tabContentMen">
                                        @foreach($categories as $category)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                 id="pills-{{$category->slug}}"
                                                 role="tabpanel"
                                                 aria-labelledby="pills-{{$category->slug}}-tab">
                                                <div class="d-flex justify-content-center">
                                                    <p class="text-center fs-1">
                                                        {{ $category->description }}
                                                    </p>
                                                </div>
                                                <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                                                    @foreach($category->products->take(4) as $product)
                                                        <livewire:product-card :product="$product"/>
                                                    @endforeach
                                                </div>
                                                <div class="col-12 d-flex justify-content-center mt-5">
                                                    <a class="btn btn-lg btn-dark" href="#"
                                                       onclick="showCategory({{ $category->id }})"
                                                       data-bs-toggle="modal" data-bs-target="#CategoryModel">
                                                        {{ __('elements.view_more') }}
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

        {{-- Start Best-deals-section --}}
        @if($bestDealsCollection->status)
            <section class="py-0">
                <div class="container">
                    <div class="row h-100">
                        <div class="col-lg-7 mx-auto text-center mt-7 mb-5">
                            <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">{{ $bestDealsCollection->name }}</h5>
                        </div>
                        <div class="col-12">
                            <div class="carousel slide" id="carouselBestDeals" data-bs-touch="false" data-bs-interval="false">
                                <div class="carousel-inner">
                                    <x-card.careousel-product class="active" data-bs-interval="10000">
                                        @foreach($bestDealsCollection->products->take(4) as $product)
                                            <livewire:product-card :product="$product"/>
                                        @endforeach
                                    </x-card.careousel-product>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <a class="btn btn-lg btn-dark" onclick="showCollection({{ $bestDealsCollection->id }})" href="" data-bs-toggle="modal" data-bs-target="#CollectionModel">
                                {{ __('elements.view_all') }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- End Best-deals-section --}}

        {{-- Strat collections Section --}}
        <section>
            <div class="container">
                <h3 class="pb-3 {{ arRight() }}">{{ __('home.Collections') }} </h3>
                <div class="row h-100 g-2 py-1 d-flex justify-content-center">
                    @foreach($collections as $collection)
                        <div class="col-md-4">
                            <livewire:collection-card :collection="$collection" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- End collections Section --}}

        {{-- Strat New Arraivels Section --}}
        @if($newArrivalsCollection->status)
            <section class="py-0">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fs-3 fs-lg-5 lh-sm mb-3">{{ $newArrivalsCollection->name }}</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselNewArrivals" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                                        @foreach($newArrivalsCollection->products->take(4) as $product)
                                            <livewire:product-card :product="$product"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5">
                        <a class="btn btn-lg btn-dark" onclick="showCollection({{ $newArrivalsCollection->id }})" href="" data-bs-toggle="modal" data-bs-target="#CollectionModel">
                            {{ __('elements.view_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
        @endif
        {{-- End New Arraivels Section --}}

        {{-- Strat Best sellers Section --}}
        @if($bestSellersCollection->status)
            <section>
                <div class="container">
                    <div class="row h-100">
                        <div class="col-lg-7 mx-auto text-center mb-6">
                            <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ $bestSellersCollection->name }}</h5>
                        </div>
                        <div class="col-12">
                            <div class="carousel slide" id="carouselBestDeals" data-bs-touch="false" data-bs-interval="false">
                                <div class="carousel-inner">
                                    <x-card.careousel-product class="active" data-bs-interval="10000">
                                        @foreach($bestSellersCollection->products->take(4) as $product)
                                            <livewire:product-card :product="$product"/>
                                        @endforeach
                                    </x-card.careousel-product>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <a class="btn btn-lg btn-dark" onclick="showCollection({{ $bestSellersCollection->id }})" href="" data-bs-toggle="modal" data-bs-target="#CollectionModel">
                                {{ __('elements.view_all') }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- End Best sellers Section --}}

        {{-- Start Categories section --}}
        <section class="py-0" id="categories">
            <div class="container">
                <h3 class="pb-3 {{ arRight() }}">{{__('home.Categories')}}  </h3>
                <div class="row h-100 g-0 d-flex justify-content-center">
                    <div class="col-md-12 h-100">
                        <div class="row h-100 g-0 d-flex justify-content-center">
                            @foreach($categories as $category)
                                <livewire:category-card :category="$category" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- end of .container-->

        </section>
        {{-- End Categories section --}}
    </main>
    <script>
        const singleProductModel = document.getElementById('singleProduct')

        let thumbnail   = null;
        let smallImages = null;
        let sizeBoxes   = null;

        function load() {
            thumbnail   = document.querySelector('#thumbnail');
            smallImages = document.querySelectorAll('.sm-img');
            sizeBoxes   = document.querySelectorAll('.size-square');
        }

        function showCollection($id) {
            Livewire.emit('showCollection', $id);
        }

        function showCategory($id) {
            Livewire.emit('showCategory', $id);
        }

        function changeSize(currentBox) {
            for (const box of sizeBoxes) {
                box.classList.remove('size-square-active');
            }
            currentBox.classList.add('size-square-active')
        }

        function changeImg(img, el) {
            unActiveElements();
            el.classList.add('sm-img-active')
            thumbnail.src = img;
        }

        function unActiveElements() {
            for (const img of smallImages) {
                img.classList.remove('sm-img-active');
            }
        }
    </script>
</x-layout.main>

