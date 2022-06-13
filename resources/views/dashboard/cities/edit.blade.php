<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5 pt-5">
        <div class="card card-body mx-3 mx-md-4 mt-n6 mt-5">
            @if($errors->any())
                <div class="alert alert-danger text-white pb-1" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row d-flex justify-content-center">
                <h2 class="text-center">Edit a City</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.cities.update', $city) }}">
                        @csrf
                        @method('PATCH')

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="city_name" class="form-label">City Name</label>
                            <input id="city_name" name="city_name" type="text" class="form-control" value="{{ old('city_name') ?? $city->name }}">
                        </div>


                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="city_price" class="form-label">City Price</label>
                            <input id="city_price" name="city_price" type="text" class="form-control" value="{{ old('city_price') ?? $city->price }}">
                        </div>

                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-dark w-100 p-1 fs-6" value="Update">
                        </div>
                    </form>

                    <form method="POST" action="{{ route('admin.cities.destroy', $city) }}">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
