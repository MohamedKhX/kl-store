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
                <h2 class="text-center">Create a new collection</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.collections.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="collection_name" class="form-label">Collection Name</label>
                            <input id="collection_name" name="collection_name" type="text" class="form-control" value="{{ old('collection_name') }}">
                        </div>
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="collection_title" class="form-label">Collection Title</label>
                            <input id="collection_title" name="collection_title" type="text" class="form-control" value="{{ old('collection_title') }}">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea placeholder="Collection Description..." class="form-control" name="collection_description" id="collection_description" cols="30" rows="10">{{ old('collection_description') }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="collection_thumbnail" class="form-label">Collection Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="collection_thumbnail" name="collection_thumbnail" type="file" class="form-control" value="{{ old('collection_thumbnail') }}">
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="collection_status" type="checkbox" id="collection_status" checked>
                            <label class="form-check-label" for="collection_status">Collection Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-primary w-100 p-1 fs-6" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
