<x-layout.main>
    <x-slot name="style">
        <style>
            .singleProduct {
                width: 35rem;
                border-radius: 5px;
            }

             .sm-img-active {
                filter: brightness(100%) !important;
            }

            .sm-img {
                border: 2px solid rgba(25, 68, 70, 0.49);
                width: 8rem;
                margin-bottom: 2.5rem;
                cursor: pointer;
                border-radius: 5px;
                filter: brightness(70%);
                transition: all .2s;
            }

            .sm-img:hover {
                filter: brightness(100%) !important;
            }

            .sm-images-box {
                overflow: scroll;
                max-height: 45rem;
            }

            .description {
                font-size: 1.1rem;
                text-align: justify;
            }

            .color-img:not(:last-child) {
                margin-right: 1rem;
            }

            .color-img {
                filter: brightness(70%);
                border: 2px solid rgba(0, 0, 0, 0.49);
                width: 5rem;
                cursor: pointer;
                border-radius: 2px;
                transition: all .2s;
            }

            .color-img:hover {
                filter: brightness(100%) !important;
            }

            .size-square {
                display: flex;
                align-items: center;
                padding: .6rem 1.2rem;
                border: 1px solid #cacaca;
                font-weight: bold;
                color: black;
                cursor: pointer;
                transition: all .2s;
                color: rgba(0,0,0, .9);
            }

            .size-square:not(:last-child) {
                margin-right: 1rem;
            }

            .size-square:hover {
               border-color: black;
            }

            .size-square-active {
                color: black;
                border: 3px solid black;
            }
        </style>
    </x-slot>

    <main class="main" id="top">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-2 d-none d-sm-block">
                                <div class="sm-images-box d-flex flex-column">
                                    @foreach($color->images as $image)
                                        <img onclick="changeImg('{{ $image }}', this)" class="img-fluid sm-img {{ $loop->first ? 'sm-img-active' : '' }}" src="{{ $image }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="d-none d-sm-block">
                                    <img src="{{ $product->thumbnail }}" id="thumbnail" class="img-fluid singleProduct" alt="">
                                </div>
                                <div class="d-block d-sm-none">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($color->images as $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ $image }}" class="d-block w-100" alt="...">
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
                    </div>
                    <div class="col-12 col-lg-6 p-xxl-5 pt-4">
                        <div class="pt-xxl-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2>{{ $product->name }}</h2>
                                <h5>{{ $color->price }}$</h5>
                            </div>
                            <div>
                                <p class="description">{{ $product->description }}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3>
                                    Color
                                </h3>
                            </div>
                            <div class="mt-3 d-flex justify-content-center d-sm-block">
                                @foreach($product->colors as $key => $color)
                                    <a href="{{ route('product-color', ['product' => $product, 'color' => $key + 1]) }}">
                                        <img class="img-fluid color-img {{ $key +1  === $colorId ? 'sm-img-active' : '' }}" src="https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a.jpg" alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3>
                                    Size
                                </h3>
                            </div>
                            <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                                @foreach($color->sizes as $size)
                                    <div class="size-square {{ $loop->first ? 'size-square-active' : '' }}">{{ $size }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-5 mt-2 p-lg-4 d-flex justify-content-center">
                            <a class="btn btn-lg btn-dark w-100 w-md-50" href="">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <livewire:product id="3-"/>
    </main>

    <script>
        const thumbnail = document.querySelector('#thumbnail');
        const smallImages = document.querySelectorAll('.sm-img');

        /*
        * Order
        * */
        const colorSelected = '';
        const sizeSelected = '';
        const quantity = '';


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
