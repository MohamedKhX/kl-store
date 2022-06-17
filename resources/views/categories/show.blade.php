<x-layout.main>
    {{-- Single Product Model --}}
    <div class="modal fade" id="singleProduct" tabindex="-1" aria-labelledby="singleProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <livewire:single-product-model />
        </div>
    </div>
    {{-- End Single Product Model --}}

    {{-- Start Header-Section --}}
{{--
    @include('homeLayout._header')
--}}
    {{-- End Header-Section --}}

    <section>
        <div class="container mt-5">
            <div class="row h-100">
                <div class="col-lg-7 mx-auto text-center mb-5">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-2">{{ __('home.shop_by_category') }}</h5>
                </div>
                <div class="col-12">
                    <nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
                                <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men" role="tablist">
                                    @foreach($categories as $category)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $category->id === $currentCategory->id ? 'active' : null }}"
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
                                        <div class="tab-pane fade {{ $category->id === $currentCategory->id ? 'show active' : '' }}"
                                             id="pills-{{$category->slug}}"
                                             role="tabpanel"
                                             aria-labelledby="pills-{{$category->slug}}-tab">
                                            <livewire:category-tab :category="$category" :current-category="$currentCategory"/>
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
