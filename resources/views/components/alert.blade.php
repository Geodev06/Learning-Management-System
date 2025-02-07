<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    <strong>{{ $title ??'' }} </strong> <br> <span class="font-12">{{ $message ?? '' }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>