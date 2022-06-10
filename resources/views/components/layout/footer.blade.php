<footer class="py-0 pt-7">
    <div class="container ">
        <div class="row d-flex justify-content-center justify-content-md-start">
            <div class="col-6 col-lg-2 mb-3 text-center text-sm-start">
                <h5 class="lh-lg fw-bold text-1000">{{ __('footer.customer_care') }}</h5>
                <ul class="list-unstyled mb-md-4 mb-lg-0">
                    <li class="lh-lg"><a class="text-800 text-decoration-none" href="{{ route('contact') }}">{{ __('footer.contact_us') }}</a></li>
                    <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">{{ __('footer.privacy_and_policy') }}</a></li>
{{--
                    <li class="lh-lg"><a class="text-800 text-decoration-none" href="{{ route('faqs') }}">Faqs</a></li>
--}}
                    <li class="lh-lg">
                        <a class="text-800 text-decoration-none" href=""
                           data-bs-toggle="modal" data-bs-target="#CartModel"
                        >
                            {{ __('footer.my_cart') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-auto ms-auto  d-flex flex-column align-items-center justify-content-center">
                <p class="text-800">
                    <svg class="feather feather-phone me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg><span class="text-800">+{{ getPhoneNumber() }}</span>
                </p>
                <p class="text-800">
                    <svg class="feather feather-mail me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg><span class="text-800">{{ getStoreEmail() }}</span>
                </p>
            </div>
        </div>
    </div>
</footer>
