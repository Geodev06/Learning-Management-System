<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Type</th>
                @if(Auth::user()->role == 'STUDENT')

                @else
                <th>Submitted by</th>

                @endif
                <th>Date Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assessments as $item)
            <tr>

                @if($item->type == 'MC')
                <td><label class="badge badge-primary">Multiple Choice</label></td>
                @elseif($item->type == 'I')
                <td><label class="badge badge-danger">Identification</label></td>
                @elseif($item->type == 'E')
                <td><label class="badge badge-success">Essay</label></td>
                @else
                <td><label class="badge badge-dark">Hands On</label></td>
                @endif

                @if(Auth::user()->role == 'STUDENT')

                @else
                <td>{{ ucfirst($item->creator) }} </td>
                @endif
                <td class="text-dark"> {{ $item->created_at->format('F d, Y -- h:i A') }} </td>

                @if(Auth::user()->role == 'ADMIN' OR Auth::user()->role == 'TEACHER')
                <td>
                    <a href="/assessment/{{ encrypt($item->module_id) }}/{{ encrypt($item->lesson_id) }}/{{ encrypt($item->id) }}" class="btn btn-primary btn-sm text-white">View</a>
                </td>
                @endif

                @if(Auth::user()->role == 'STUDENT')
                <td>
                    <a href="/view-assessment-result/{{ encrypt($item->id) }}" class="btn btn-primary btn-sm text-white">View</a>
                </td>
                @endif
            </tr>
            @empty

            @if(Auth::user()->role == 'STUDENT')
            <tr>
                <td colspan="3">No Submmited Activities</td>
            </tr>
            @else
            <tr>
                <td colspan="4">No Pending Tasks</td>
            </tr>
            @endif
            @endforelse

        </tbody>
    </table>

    {{ $assessments->links() }}
</div>