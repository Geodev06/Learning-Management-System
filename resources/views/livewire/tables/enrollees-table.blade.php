<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>

                <th width="40%">Progress</th>
                <th width="20%">Date Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollees as $item)

            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img class="img-sm rounded-10" src="https://static.vecteezy.com/system/resources/previews/000/350/111/original/vector-male-student-icon.jpg" alt="profile">
                        <div class="wrapper ms-3">
                            <p class="ms-1 mb-1 fw-light">{{ base64_decode($item->student_info->first_name) }} {{ base64_decode($item->student_info->last_name) }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                            <p class="text-success">{{ number_format($item->progress , 2)}}%</p>
                            <p>{{ $item->user_assessments }} /{{ $total_activity }}</p>
                        </div>
                        <div class="progress progress-md">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ intVal($item->progress) }}%" aria-valuenow="{{ intVal($item->progress) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </td>
                <td>
                    {{ $item->student_info->created_at->format('F d, Y') }}
                </td>
            </tr>
            @empty

            <tr>
                <td colspan="3">No Enrollees</td>
            </tr>
            @endforelse

        </tbody>
    </table>

    {{ $enrollees->links() }}
</div>