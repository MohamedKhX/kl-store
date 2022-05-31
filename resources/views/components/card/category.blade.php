@props(['name', 'img' => 'img/gallery/sunglasses.png', 'link' => '#'])

<div class="col-md-6">
    <div class="card card-span h-100 text-white">
        <img class="card-img h-100" src="{{ url('storage/' . $img) }}" alt="..." />
        <div class="card-img-overlay bg-dark-gradient rounded-0">
            <div class="p-5 p-xl-5 p-md-0">
                <h3 class="text-light">{{ $name }}</h3>
            </div>
        </div><a class="stretched-link" href="{{ $link  }}"></a>
    </div>
</div>
