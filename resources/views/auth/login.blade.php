<x-layout.main>
    <x-slot name="style">
        <style>
            .form-control {
                padding: 0.5rem 1rem;
            }

            .form-control::placeholder {
                color: gray !important;
            }
            h1, h4 {
                color: rgba(0, 0, 0, 0.84) !important;
            }
        </style>
    </x-slot>
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-10 col-lg-9 col-xl-7 col-xxl-5">
                    <div class="d-flex flex-column mt-7 text-center justify-content-center align-items-center">
                        <h1>Welcome back!</h1>
                        <h4>Please login in</h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mt-4">
                            <label class="form-label" for="email">Email: </label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email" required>
                            @error('email')
                                <div id="email-error" class="form-text text-danger" style="font-size: 1rem">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="password">Password: </label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="forget-password">
                                <a style="color: #2c1a0d;" href="#">
                                    Forget password?
                                </a>
                            </label>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" class="btn btn-primary btn-lg w-100 text-white fw-bold" value="Sign in">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout.main>
