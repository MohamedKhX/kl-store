@props(['name', 'price', 'img' => 'img/gallery/flat-hill.png', 'oldPrice' => null,])

<div class="col-sm-6 col-md-3 mb-3 mb-md-0 mt-5">
    <div class="card card-span text-white">
        <img class="img-fluid " src="{{ $img }}" alt="..." />
        <div class="card-img-overlay ps-0"> </div>
        <div class="card-body ps-0 bg-200">
            <h5 class="fw-bold text-1000 text-truncate">{{ $name }}</h5>
            <div class="fw-bold">
                @if($oldPrice)
                    <span class="me-2 text-danger text-decoration-line-through">{{ $oldPrice }}</span>
                @endif
                <span class="text-800">{{ $price }}</span>
            </div>
        </div>
        {{ isset($link) ? $link : '' }}
    </div>
</div>
