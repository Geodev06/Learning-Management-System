@forelse($messages as $message)
<div class="row">
    <div class="col-lg-12 p-3">
        @if($message->created_by == Auth::user()->id)
        <div class="d-flex align-items-center float-end mb-2 text-white ">
            <div>
                <div class="bg-success mx-2 mb-0" style="border-radius: 5px;">
                    <p class="p-2">{{ $message->message }} </p>
                </div>

                @if($message->seen_flag == 1) 
                <p class="m-0 font-12 text-muted float-end">Seen {{ $message->updated_at->format('F d, Y h:i A') }} <i class=" fa fa-check"> </i></p>
                @else
                <p class="m-0 font-12 text-muted float-end">Sent <i class=" fa fa-check-circle-o"> </i></p>
                @endif

            </div>


            <img class="img-xs rounded-circle" src="{{ asset(Auth::user()->profile ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' ) }}" alt="Profile image">
        </div>
        @else
        <div class="d-flex align-items-center  mb-2 text-white ">
            <img class="img-xs rounded-circle" src="{{ asset($message->creator->profile ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' ) }}" alt="Profile image">

            <div class="bg-primary mx-2" style="border-radius: 5px;">
                <p class="p-2">{{ $message->message }} </p>
            </div>
        </div>
        @endif
    </div>
</div>
@empty
<p>No Message</p>
@endforelse