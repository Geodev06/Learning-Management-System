<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="card-title card-title-dash">Top Performer</h4>
                            </div>
                        </div>
                        <div class="mt-3">
                            @forelse($tops as $user)
                            <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                <div class="d-flex">
                                    <img class="img-sm rounded-10" src="https://static.vecteezy.com/system/resources/previews/000/350/111/original/vector-male-student-icon.jpg" alt="profile">
                                    <div class="wrapper ms-3">
                                        <p class="ms-1 mb-1 fw-bold">{{ $user->full_name ?? '' }}</p>
                                        <small class="text-muted mb-0">{{ number_format($user->points, 2) }} pts.</small>
                                    </div>
                                </div>
                                <div class="text-muted text-small"> 1h ago </div>
                            </div>
                            @empty
                            <p>No Data</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>