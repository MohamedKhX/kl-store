@push('styles')
    <style>
        .bg-holder.overlay-light::before {
            background: rgba(255, 255, 255, {{ getFilter() }});
        }
    </style>
@endpush

<section class="py-4 bg-light-gradient border-bottom border-white border-5">
    <div class="bg-holder overlay overlay-light" style="
    background-image:url({{ getStoreThumbnail() }});
    background-size:cover;
    ">
    </div>
    <!--/.bg-holder-->

    <div class="container">
        <div class="row flex-center">
            <div class="col-12 mb-9">
                <div class="d-flex align-items-center flex-column text-center">
                    <h1 class="mt-11 fw-bold">{{ __('header.store_title') }}</h1>
                    <h1 class="fs-4 fs-lg-8 fw-bold fs-md-6 fw-normal ">{{ __('header.store_description') }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
