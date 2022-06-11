<x-layout.main>
    <section>
        <div class="container py-4 mt-6">

            @if(Session::has('success'))
                <div class="alert alert-success {{arRight()}}">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <form id="contactForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control ps-3 mt-3 {{arRight()}}" id="name" name="name" type="text" placeholder="{{ __('elements.name') }}" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input class="form-control ps-3  mt-4 {{arRight()}}" id="emailAddress" name="email" type="email" placeholder="{{ __('elements.email_address') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control ps-3 mt-4 {{arRight()}}" name="message" id="message" type="text" placeholder="{{ __('elements.message') }}" style="height: 10rem;"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-dark btn-lg mt-3" type="submit">{{ __('elements.submit') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout.main>
