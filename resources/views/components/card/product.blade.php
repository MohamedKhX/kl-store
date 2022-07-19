@props(['name', 'price', 'img' => 'img/gallery/flat-hill.png', 'oldPrice' => null, 'outer_description' => null])
{{-- col-sm-12  --}}
<div class="mb-3 mb-md-0 mt-3">
    <div class="card card-span text-white">
        <img class="img-fluid " src="{{ $img }}" alt="..." />
        <div class="card-img-overlay ps-0"> </div>
        <div class="card-body ps-0 bg-200">
            <h5 class="fw-bold mb-0 text-1000 text-truncate {{ arRight() }}">{{ $name }}</h5>
            @if($outer_description)
                <p style="color: #5e5e5e" class="fs--1 {{arRight()}}">{{ $outer_description }}</p>
            @endif
            <div class="fw-bold {{ arRight() }}">
                @if(ar())
                    <span class="text-800 ">{{ $price }}</span>
                    @if($oldPrice)
                        <span style="color: #ab0000" class="ms-2 text-decoration-line-through">{{ $oldPrice }}</span>
                    @endif
                @else
                    @if($oldPrice)
                        <span class="me-2 text-danger text-decoration-line-through">{{ $oldPrice }}</span>
                    @endif
                    <span class="text-800 ">{{ $price }}</span>
                @endif
            </div>
        </div>
        {{ isset($link) ? $link : '' }}
    </div>
</div>
