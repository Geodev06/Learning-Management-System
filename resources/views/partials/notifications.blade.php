<a class="dropdown-item py-3 border-bottom" href="{{ route('notifications_view') }}">
    <p class="mb-0 fw-medium float-start">You have {{ $unseen_count }} new notifications</p>
    <span class="badge badge-pill badge-primary float-end">View all</span>
</a>

@forelse($notifications as $item)
<a class="dropdown-item preview-item py-3 item-link" href="{{ $item->link }}" data-id="{{ $item->id }}">
    <div class="preview-thumbnail">
        <i class="fa {{ $item->icon }} m-auto text-primary"></i>
    </div>
    <div class="preview-item-content">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="preview-subject fw-normal text-dark mb-1">{{ ucwords($item->type) }}</h6>
            <p class="font-12">{{ $item->created_at->diffForHumans() }}</p>
        </div>
        <div>
            <p class="mb-0"><b>{{ $item->title }}</b></p>
            <p class="fw-light small-text mb-0">{{ $item->message }}</p>
        </div>
    </div>
</a>
@empty
<a class="dropdown-item preview-item py-3">
    No Notifications
</a>
@endforelse

<style>
    .dropdown-item {
        display: flex;
        width: 100%;
        padding: 0.75rem 1rem;
        box-sizing: border-box;
    }

    .preview-item {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .preview-thumbnail {
        flex-shrink: 0;
        margin-right: 1rem;
    }

    .preview-item-content {
        width: 100%;
    }

    * {
        box-sizing: border-box;
    }
</style>

<script>
    $(document).ready(function(e) {
        $('.item-link').on('click', function(e) {
            var id = $(this)[0].dataset.id

            $.post('/seen', {
                _token: "{{ csrf_token() }} ",
                id: id
            }, (res) => {
                console.log(res)
            })
        })
    })
</script>