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


            .size-square:before {
                content: " ";
                position: absolute;
                z-index: -1;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border: 3px solid transparent;
            }


            .size-square {
                position: relative;
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

            .size-square-active:before {
                color: black;
                border-color: black;
            }
        </style>
        @livewireScripts
    </x-slot>

    <main class="main" id="top">
        <section>
            <livewire:product :identifier="$product->id" :color-id="$color->id"/>
        </section>
    </main>

    <script>
        const thumbnail   = document.querySelector('#thumbnail');
        const smallImages = document.querySelectorAll('.sm-img');
        const sizeBoxes   = document.querySelectorAll('.size-square');

        /*
        * Order
        * */
        const colorSelected = '';
        const sizeSelected = '';
        const quantity = '';

        function changeSize(key, box) {
            for (const box of sizeBoxes) {
                box.classList.remove('size-square-active');
            }


            for (let i = 0; i < sizeBoxes.length; i++) {
                if(i === key) {
                    box.classList.add('size-square-active');
                }
            }
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
