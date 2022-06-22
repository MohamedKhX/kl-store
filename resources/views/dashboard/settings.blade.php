<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2 d-flex justify-content-center align-items-center">
                <div class="col-auto my-auto">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <h5 class="mb-1">
                            Website Settings
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-xl-8">
                        @if(session()->has('success'))
                            <div class="alert alert-success text-white mb-0" role="alert">
                                <strong>Success!</strong> {{ session()->get('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger text-white pb-1" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card card-plain h-100 p-0 p-md-5 shadow-lg bg-body">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Platform Settings</h6>
                            </div>
                            <div class="card-body p-3">
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Users</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input name="ability_to_create_accounts" class="form-check-input ms-auto" type="checkbox" id="ability_to_create_accounts" {{ $ability_to_create_accounts ? 'checked' : null }}>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="ability_to_create_accounts">Can Users create accounts</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input name="ability_to_login" class="form-check-input ms-auto" type="checkbox" id="ability_to_login" {{ $ability_to_login ? 'checked' : null }}>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="ability_to_login">Can users login in</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input name="ability_to_order" class="form-check-input ms-auto" type="checkbox" id="ability_to_order" {{ $ability_to_order ? 'checked' : null }}>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="ability_to_order">Can users order products</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <input name="app_active" class="form-check-input ms-auto" type="checkbox" id="app_active" {{ $app_active ? 'checked' : null }}>
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="app_active">App Active</label>
                                            </div>
                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Phone Number</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="phone_number" class="form-label"></label>
                                                <input name="phone_number" id="phone_number" type="text" class="form-control" value="{{ $phone_number }}">
                                            </div>
                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Site Email</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="site_email" class="form-label"></label>
                                                <input name="site_email" id="site_email" type="text" class="form-control" value="{{ $site_email }}">
                                            </div>
                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Site Name in English</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="site_name" class="form-label"></label>
                                                <input name="site_name" id="site_name" type="text" class="form-control" value="{{ $site_name }}">
                                            </div>

                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Store Title (en)</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="store_title" class="form-label"></label>
                                                <input name="store_title" id="store_title" type="text" class="form-control" value="{{ $store_title }}">
                                            </div>
                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Store Title (ar)</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="store_title_ar" class="form-label"></label>
                                                <input name="store_title_ar" id="store_title_ar" type="text" class="form-control" value="{{ $store_title_ar }}">
                                            </div>
                                        </li>

                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Store Thumbnail</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="store_thumbnail" class="form-label"></label>
                                                <input name="store_thumbnail" id="store_thumbnail" type="file" class="form-control" value="{{ $store_thumbnail }}">
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Thumbnail Filter</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="thumbnail_filter" class="form-label"></label>
                                                <input name="thumbnail_filter" id="thumbnail_filter" type="text" class="form-control" value="{{ $thumbnail_filter }}">
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <label class="form-label">Store Logo</label>
                                            <div class="input-group input-group-outline my-2">
                                                <label for="store_icon" class="form-label"></label>
                                                <input name="store_icon" id="store_icon" type="file" class="form-control" value="{{ $store_icon }}">
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <label for="store_description" class="form-label">Store Description (en)</label>
                                            <div class="input-group input-group-outline my-2">
                                                <textarea name="store_description" id="store_description" cols="30" rows="4" class="form-control">{{ $store_description }}</textarea>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <label for="store_description_ar" class="form-label">Store Description (ar)</label>
                                            <div class="input-group input-group-outline my-2">
                                                <textarea name="store_description_ar" id="store_description_ar" cols="30" rows="4" class="form-control">{{ $store_description_ar }}</textarea>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-center mt-3">
                                        <input type="submit" class="btn btn-primary w-100 fs-6 py-2" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-layout.Dashboard.main>
