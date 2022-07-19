<x-layout.main>
    <section id="productSection" class="p-3 pt-7">
        <livewire:product :product="$product" :color-id="$colorId"/>
    </section>

    <section class="p-3">
        <livewire:related-products :product="$product"/>
    </section>

    {{-- Strat collections Section --}}
    @if($collections->count())
        <section>
            <div class="container">
                <h3 class="pb-3 {{ arRight() }}">{{ __('home.Collections') }} </h3>
                <div class="row h-100 g-2 py-1 d-flex justify-content-center">
                    <div class="">
                        <div id="collectionsCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($collections as $collection)
                                    <div class="carousel-item {{$loop->first ? "active" : null}}">
                                        <x-card.collection :name="$collection->name" :img="$collection->thumbnail">
                                            <x-slot name="link">
                                                <a class="stretched-link" href="{{ route('show-collection', $collection) }}"></a>
                                            </x-slot>
                                        </x-card.collection>
                                    </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#collectionsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
    {{-- End collections Section --}}

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
                                        href="{{ url('/#category=' . $category->slug) }}"
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

</x-layout.main>
