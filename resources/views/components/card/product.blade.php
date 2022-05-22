@props(['name', 'price', 'img' => 'img/gallery/flat-hill.png', 'oldPrice' => null,])

<div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
    <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="{{ $img }}" alt="..." />
        <div class="card-img-overlay ps-0"> </div>
        <div class="card-body ps-0 bg-200">
            <h5 class="fw-bold text-1000 text-truncate">{{ $name }}</h5>
            <div class="fw-bold">
                @if($oldPrice)
                    <span class="text-600 me-2 text-decoration-line-through">{{ $oldPrice }}</span>
                @endif
                <span class="text-primary">{{ $price }}</span>
            </div>
        </div>
        <a class="stretched-link" href="#"></a>
        <a class="btn btn-lg btn-dark" href="#!">Add to cart</a>

    </div>
</div>
