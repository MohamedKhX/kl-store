@props(['name', 'price', 'img' => 'img/gallery/full-body.png'])

<div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
    <div class="card card-span h-100 text-white"><img class="card-img h-100" src="{{ $img }}" alt="..." />
        <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
            <h6 class="text-primary fs-1">${{ $price }}</h6>
            <h4 class="text-light fs-3">{{ $name }}</h4>
        </div><a class="stretched-link" href="#"></a>
    </div>
</div>
