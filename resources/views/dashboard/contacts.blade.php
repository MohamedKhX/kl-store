<x-layout.Dashboard.main>
    <div class="container">

        <div class="mt-4">
            @if(session()->has('success'))
                <div class="alert alert-success text-white" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                </div>
            @endif
            <h4 class="text-center">
                 Contacts
            </h4>
            <div class="mt-4 d-flex flex-column align-items-center justify-content-center">
                @foreach($contacts as $contact)
                    <div class="card w-100 w-md-75 w-lg-50 my-5">
                        <div class="card-body text-center mt-2 p-3">
                            <div class="">
                                <div>
                                    <div>
                                        <h6>
                                            <strong class="">Name : <span class="text-primary">{{ $contact->name }}</span></strong>
                                        </h6>
                                        <h6>
                                            <strong class="">Email : <span class="text-primary">{{$contact->email}}</span></strong>
                                        </h6>
                                    </div>
                                    <a class="text-danger" href="{{ route('dashboard-contacts.delete', $contact) }}">
                                        Delete
                                    </a>
                                    <hr>
                                </div>
                                <div>
                                    <p>
                                        {{ $contact->message }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between">
                            <p class="font-weight-normal my-auto"></p>
                            <p class="font-weight-normal my-auto me-4">
                                <span class="text-danger">{{ $contact->created_at->diffForHumans() }}</span>
                            </p>
                            <p class="font-weight-normal my-auto"></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
