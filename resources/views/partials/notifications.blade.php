<a class="dropdown-item py-3 border-bottom">
    <p class="mb-0 fw-medium float-start">You have {{ $unseen_count }} new notifications </p>
    <span class="badge badge-pill badge-primary float-end">View all</span>
</a>
@forelse($notifications as $item)
<a class="dropdown-item preview-item py-3">
    <div class="preview-thumbnail">
        <i class="mdi mdi-alert m-auto text-primary"></i>
    </div>
    <div class="preview-item-content">
        <h6 class="preview-subject fw-normal text-dark mb-1">{{ ucwords($item->type) }} </h6>
        <p class="mb-0"><b>{{ $item->title }}</b> </p>
        <p class="fw-light small-text mb-0">{{ $item->message }} </p>
    </div>
</a>
@empty
<a class="dropdown-item preview-item py-3">
    No Notifications
</a>
@endforelse