<div>
    @if($count >= 1)
        <span style="top: 5px; left: 26px;" class="position-absolute translate-middle badge rounded-pill bg-danger">
            +{{ $count }}
            <span class="visually-hidden">unread messages</span>
        </span>
    @endif
</div>
