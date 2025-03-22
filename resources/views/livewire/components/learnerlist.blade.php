<div class="row">

    @forelse($users as $item)
    <div class="col-lg-2 mb-2">
        <div class="card card-rounded h-100" style="cursor: pointer;" wire:click="profile_preview({{ $item->id }})">
            <div class="card-body text-center">
                <img
                    class="img-md rounded-circle"
                    style="max-width: 50px; max-height:50px; height: 50px; width: 50px"
                    src="{{ $item->profile == null ? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' : asset($item->profile) }}" alt="" srcset="">
                <div class="card-title mb-0 mt-4">
                    Ageo Agnote
                </div>
                <p class="m-0">BS information Technology</p>
                <p>Last Login : {{ $item->updated_at->diffForHumans() }}</p>
                <hr>

                @if($item->learning_modality == 'R')
                <span class="badge badge-dark"><b>Reading & Writing</b></span>
                @endif

                @if($item->learning_modality == 'A')
                <span class="badge badge-primary"><b>Auditory</b></span>
                @endif

                @if($item->learning_modality == 'V')
                <span class="badge badge-success"><b>Visual</b></span>
                @endif

                @if($item->learning_modality == 'K')
                <span class="badge badge-danger"><b>Kinesthetic</b></span>
                @endif

                @if($item->learning_modality == null OR $item->learning_modality == '')
                <p>Not yet available</p>
                @endif
            </div>
        </div>
    </div>
    @empty

    @endforelse

    {{ $users->links() }}
</div>