<div class="row no-gutters h-100">

    <div class="col-lg-12 p-0">
        <div class="card">
            <div class="card-body">
                <h3 class="text-primary">Pre-Assesment</h3>
                <p class="card-description">Please take a moment to complete this survey. Your feedback is valuable to us and will help improve the system. All responses will remain confidential. </p>

                @if(session('error'))
                <x-alert title="Error" message="{{ session('error') }}" type="danger" />
                @endif

                <form class="forms-sample material-form">


                    @forelse($questions as $question)
                    <hr>
                    <h5><b>{{ $question->id }}. {{ ucfirst($question->question) }}</b></h5>
                    <div class="my-2 mb-4 d-flex align-items-center">

                        <div class="form-check mx-2">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c1_val }}" class="form-check-input">{{ $question->question_c1_label }} <i class="input-helper"></i></label>
                        </div>

                        <div class="form-check mx-2">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c2_val }}" class="form-check-input">{{ $question->question_c2_label }} <i class="input-helper"></i></label>
                        </div>

                        <div class="form-check mx-2">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c3_val }}" class="form-check-input"> {{ $question->question_c3_label }} <i class="input-helper"></i></label>
                        </div>

                        <div class="form-check mx-2">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" wire:model="question_{{ $question->id }}_{{ $question->question_c4_val }}" class="form-check-input"> {{ $question->question_c4_label }} <i class="input-helper"></i></label>
                        </div>
                    </div>
                    @empty

                    @endforelse


                    <div class="button-container">
                        <button type="button"
                            class="btn btn-rounded btn-primary"
                            wire:click="submit"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>Submit</span>
                            <span wire:loading>
                                <i class="fa fa-spinner fa-spin"></i> Loading...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @endassets

    @script
    <script>
        $wire.on('msg_alert', (data) => {

            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            }).then(function() {
                window.location.replace('/dashboard');
            });

        })
    </script>
    @endscript
</div>