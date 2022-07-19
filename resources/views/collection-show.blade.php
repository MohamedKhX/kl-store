<x-layout.main>
    @push('styles')
        <style>
            .bg-holder.overlay-light::before {
                background: rgba(0, 0, 0, .6);
            }
        </style>
    @endpush

    {{-- Single Product Model --}}
    <div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            @if($collection->products->count())
                @if(\App\Models\ProductColors::all()->count())
                    <livewire:single-product-model />
                @endif
            @endif
        </div>
    </div>
    {{-- End Single Product Model --}}

    {{-- Start Header --}}
    <section class="py-0 bg-light-gradient border-bottom border-white border-5">
        <div class="bg-holder overlay overlay-light" style="
            background-image:url({{ $collection->background ?? 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8Y2xvdGhlc3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60' }});
            background-size:cover;
        ">

        </div>
        <div class="container">
            <div class="row flex-center">
                <div class="col-12 mb-8">
                    <div class="d-flex align-items-center flex-column mt-4 text-center">
                        <h1 class="mt-8 fw-bold text-white">
                            {{ $collection->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Header --}}

    {{-- Start Collection  --}}
    <section>
        <livewire:special-collection :collection="$collection" :show-collection-name="false" :show-by-colors="true"/>
    </section>
    {{-- End Collection --}}

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
