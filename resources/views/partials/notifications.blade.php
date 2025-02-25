<a class="dropdown-item py-3 border-bottom">
    <p class="mb-0 fw-medium float-start">You have {{ $unseen_count }} new notifications </p>
    <span class="badge badge-pill badge-primary float-end">View all</span>
</a>
@forelse($notifications as $item)
<a class="dropdown-item preview-item py-3" href="{{ $item->link }}">
    <div class="preview-thumbnail">
        <i class="fa {{ $item->icon }} m-auto text-primary"></i>
    </div>
    <div class="preview-item-content">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="preview-subject fw-normal text-dark mb-1">{{ ucwords($item->type) }} </h6>
            <p class="font-12">{{ $item->created_at->diffForHumans() }} </p>
        </div>
        <p class="mb-0"><b>{{ $item->title }}</b> </p>
        <p class="fw-light small-text mb-0">{{ $item->message }} </p>
    </div>
</a>
@empty
<a class="dropdown-item preview-item py-3">
    No Notifications
</a>
@endforelse