<x-layout.main>
    {{-- Single Product Model --}}
    <div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <livewire:single-product-model />
        </div>
    </div>
    {{-- End Single Product Model --}}

    <section>
        <div class="container mt-5">
            <div class="row h-100">
                <div class="col-lg-7 mx-auto text-center mb-5">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-2">{{ __('home.shop_by_category') }}</h5>
                </div>
                <div class="col-12">
                    <nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-men">
                                <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men">
                                    @foreach($categories as $category)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{$category->id === $currentCategory->id ? 'active' : null}}"
                                                    id="pills-{{$category->slug}}-tab"
                                                    type="button"
                                                    aria-controls="pills-{{$category->slug}}"
                                                    aria-selected="true"
                                                    href="{{ route('categories.show', $category->slug) }}"
                                            >
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="pills-tabContentMen">
                                    @foreach($categories as $category)
                                        @if($category->id === $currentCategory->id)
                                            <div class="tab-pane fade show active"
                                                 id="pills-{{$category->slug}}"
                                                 role="tabpanel"
                                                 aria-labelledby="pills-{{$category->slug}}-tab">
                                                <div class="d-flex justify-content-center">
                                                    <p class="text-center fs-1">
                                                        {{ $category->description }}
                                                    </p>
                                                </div>
                                                <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                                                    @foreach($products as $product)
                                                        <livewire:product-card :product="$product"/>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex justify-content-center mt-4">
                                                    {{ $products->links() }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
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
