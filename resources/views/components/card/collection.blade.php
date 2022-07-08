@props(['name', 'img' => 'img/gallery/outfit.png'])

<div style="background-color: transparent" class="card card-span h-100 text-white">
    <div class="d-flex justify-content-center">
        <img style="border-radius: 50%; width: 15rem; height: 20rem"
             class="card-img h-100 d-flex justify-content-center"
             src="{{ url('storage/'. $img) }}"
             alt="..."
        />
    </div>
    <div class="">
        <div class="d-flex align-items-end justify-content-center h-100">
            {{ $link ? $link : '' }}
                {{ $name }}
            <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
            </svg>
        </div>
    </div>
</div>
