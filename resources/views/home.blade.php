<x-layout.main>
    <main class="main" id="top">

        {{-- Start Header-Section --}}
        @include('homeLayout._header')
        {{-- End Header-Section --}}

        {{-- Single Product Model --}}
        <div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                @if($products->count())
                    @if(\App\Models\ProductColors::all()->count())
                        <livewire:single-product-model />
                    @endif
                @endif
            </div>
        </div>
        {{-- End Single Product Model --}}

        {{-- Strat Shop by category Section --}}
        <section id="shopByCategories">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ __('home.shop_by_category') }}</h5>
                    </div>
                    <div class="col-12">
                        <nav>
                            <div x-data="{active: ''}" class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
                                    <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men" role="tablist">
                                        @foreach($categories as $category)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{$loop->first ? 'active' : ''}}"
                                                        @if($loop->first)
                                                            x-init="active = $el.id"
                                                        @changecategory.window="active = `pills-${$event.detail.category}-tab`"
                                                        @endif
                                                        @click="active = $el.id"
                                                        x-bind:class="active == 'pills-{{$category->slug}}-tab' ? 'active' : null"
                                                        id="pills-{{$category->slug}}-tab"
                                                        data-bs-toggle="pill"
                                                        data-bs-target="#pills-{{$category->slug}}"
                                                        type="button" role="tab"
                                                        aria-controls="pills-{{$category->slug}}"
                                                        aria-selected="true"
                                                >
                                                    {{ $category->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="pills-tabContentMen">
                                        @foreach($categories as $category)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                 x-bind:class="active == 'pills-{{$category->slug}}-tab' ? 'show active' : null"
                                                 x-show="active == 'pills-{{$category->slug}}-tab'"
                                                 x-transition
                                                 id="pills-{{$category->slug}}"
                                                 role="tabpanel"
                                                 aria-labelledby="pills-{{$category->slug}}-tab">
                                                <livewire:category-tab :category="$category"/>
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
            <livewire:special-collection :collection="$bestDealsCollection" />
        @endif
        {{-- End Best-deals-section --}}

        {{-- Strat collections Section --}}
        <section>
            <div class="container">
                <h3 class="pb-3 {{ arRight() }}">{{ __('home.Collections') }} </h3>
                <div class="row h-100 g-2 py-1 d-flex justify-content-center">
                    <div class="">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($collections as $collection)
                                    <div class="carousel-item {{$loop->first ? "active" : null}}">
                                        <x-card.collection :name="$collection->name" :img="$collection->thumbnail">
                                            <x-slot name="link">
                                                <a class="stretched-link" href="#" wire:click="showCollection({{$collection->id}})" data-bs-toggle="modal" data-bs-target="#CollectionModel"></a>
                                            </x-slot>
                                        </x-card.collection>
                                    </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- End collections Section --}}

        {{-- Strat New Arraivels Section --}}
        @if($newArrivalsCollection->status)
            <livewire:special-collection :collection="$newArrivalsCollection" />
        @endif
        {{-- End New Arraivels Section --}}

        {{-- Strat Best sellers Section --}}
        @if($bestSellersCollection->status)
            <div class="py-5">
                <livewire:special-collection :collection="$bestSellersCollection" />
            </div>
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
                                <x-card.category :name="$category->name" :img="$category->thumbnail">
                                    <x-slot name="link">
                                        <a
                                            style="cursor: pointer; outline: none;"
                                            class="stretched-link"
                                            href="#shopByCategories"
                                            x-data
                                            onclick="tabClear()"
                                            @click="$dispatch('changecategory', {category: '{{$category->slug}}'});"
                                        ></a>
                                    </x-slot>
                                </x-card.category>
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

        function tabClear() {
            @foreach($categories as $category)
                document.getElementById('pills-{{$category->slug}}-tab').classList.remove('active')
            @endforeach
        }
    </script>
</x-layout.main>

