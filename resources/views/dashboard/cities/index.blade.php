<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        <div class="d-flex justify-content-center justify-content-lg-end">
            <a class="btn btn-primary w-75 w-lg-25" href="{{ route('admin.cities.create') }}">Create a new city</a>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">City</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <h4 class="mb-0 text-xs">
                                        <a href="{{ route('admin.cities.edit', $city) }}">
                                            {{ $city->name }}
                                        </a>
                                    </h4>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center px-2 py-1">
                                    <h4 class="mb-0 text-xs">
                                        {{ $city->price }}
                                    </h4>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
