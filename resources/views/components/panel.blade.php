@props (['title' => 'Title'])

<div class="card my-5">
    <div class="card-header fs-4">
        {{ $title }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
