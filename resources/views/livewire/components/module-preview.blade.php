<div class="col-lg-12">
    <div class="card p-5 shadow-sm" style="background-color: #EDF3FC;">
        <div class="card-body">
            <h3><b>{{ ucfirst($module->title) }}</b></h3>
            <h5 class="mt-3">About</h5>
            <p class="card-text text-ellipsis mb-4">{{ ucfirst($module->overview) }}</p>
            <p class="mb-0"><b>Date Created :</b> {{ $module->created_at->format('F d, Y') }}</p>
            <p><b>Author :</b> {{ $module->author ?? '' }}</p>

            
            <hr>
           
            <div class="d-flex align-items-center">
                <div class="border-left-1 border p-4 rounded text-center mx-2  p-2 text-white" style="background-color: #524CFF;">
                    <p class="text-start">No. of Takers.</p>
                    <h1><b>{{ $takers ?? 0 }}</b></h1>
                </div>

                <div class="border-left-1 border p-4 rounded text-center mx-2 p-2 text-white" style="background-color: #524CFF;">
                    <p class="text-start">Average Student Grade</p>
                    <h1><b>{{ $avg_score ?? 0 }}%</b></h1>
                </div>

                <div class="border-left-1 border p-4 rounded text-center mx-2  p-2 text-white" style="background-color: #524CFF;">
                    <p class="text-start">Passing Rate</p>
                    <h1><b>{{ $passing ?? 0 }}%</b></h1>
                </div>
            </div>

            @if(!$is_added)
            <div class="button-container mt-2">
                <button type="button"
                    class="btn btn-primary"
                    wire:click="submit"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Take Course</span>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-spin"></i> Loading...
                    </span>
                </button>
            </div>

            @else
            <p class="text-success mt-2">Already Enrolled.</p>
            @endif


        </div>

    </div>

    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @endassets

    @script
    <script>
        $wire.on('success', (data) => {

            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            }).then(() => {
                window.location.href = "{{ route('learn_module', encrypt($id)) }} "

            });
        })
    </script>
    @endscript
</div>