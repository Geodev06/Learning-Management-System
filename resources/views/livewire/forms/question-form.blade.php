<div class="row mb-2">
    @assets
    <style>
        .text-wrap {
            word-wrap: break-word;
            /* Older property to handle word breaking */
            overflow-wrap: break-word;
            /* More modern property for word breaking */
            white-space: normal;
            /* Ensures normal text wrapping behavior */
            word-break: break-word;
            /* Force breaking at long words if needed */
        }

        .card-body {
            word-wrap: break-word;
            /* Ensure wrapping inside the card body */
            overflow-wrap: break-word;
        }

        .w-100 {
            width: 100%;
            /* Ensure the div takes up the full width available */
        }
    </style>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @endassets

    @if(!$openForm)
    <div class="col-lg-12">
        <div class="button-container float-end">
            <button type="button" class="btn btn-rounded btn-primary" wire:click="toggleForm()"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Add Question</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Loading...
                </span>
            </button>

        </div>
    </div>
    @endif

    @if($openForm)
    <div class="col-lg-8 {{ $openForm == TRUE? 'Close Form' : 'Add Question' }}">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample material-form">
                    @error('duplicate_choices') <span class="font-12 text-danger">{{ $message }}</span> @enderror

                    <div class="form-group w-25">
                        <input type="text" required="required" wire:model="points"
                            class="@if ($errors->has('points')) text-danger @else text-primary @endif"
                            autocomplete="off">
                        <label for="input" class="control-label">Points</label><i class="bar"></i>
                        @error('points') <span class="text-danger font-12">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-0">

                        <textarea name="" wire:model="question" id="" cols="30" rows="3"></textarea>
                        <label for="input" class="control-label">Question</label><i class="bar"></i>
                        @error('question') <span class="text-danger font-12">{{ $message }}</span> @enderror

                    </div>

                    @if($type == 'Multiple Choice')

                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <input type="text" required="required" wire:model="choice_a"
                                class="@if ($errors->has('choice_a')) text-danger @else text-primary @endif"
                                autocomplete="off">
                            <label for="input" class="control-label">Choice A</label><i class="bar"></i>
                            @error('choice_a') <span class="text-danger font-12">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" required="required" wire:model="choice_b"
                                class="@if ($errors->has('choice_b')) text-danger @else text-primary @endif"
                                autocomplete="off">
                            <label for="input" class="control-label">Choice B</label><i class="bar"></i>
                            @error('choice_b') <span class="text-danger font-12">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" required="required" wire:model="choice_c"
                                class="@if ($errors->has('choice_c')) text-danger @else text-primary @endif"
                                autocomplete="off">
                            <label for="input" class="control-label">Choice C</label><i class="bar"></i>
                            @error('choice_c') <span class="text-danger font-12">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" required="required" wire:model="choice_d"
                                class="@if ($errors->has('choice_d')) text-danger @else text-primary @endif"
                                autocomplete="off">
                            <label for="input" class="control-label">Choice D</label><i class="bar"></i>
                            @error('choice_d') <span class="text-danger font-12">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group w-25">
                        <label for="correct" style="color: seagreen;"><b>Correct Answer</b></label>
                        <select class="form-select form-select-sm" wire:model="correct" name="correct" id="correct">
                            <option value="" selected>Choose One</option>
                            <option value="A">Choice A</option>
                            <option value="B">Choice B</option>
                            <option value="C">Choice C</option>
                            <option value="D">Choice D</option>
                        </select>
                        @error('correct') <span class="text-danger font-12">{{ $message }}</span> @enderror
                    </div>

                    @endif

                    @if($type == 'Identification')
                    <div class="form-group ">
                        <input type="text" required="required" wire:model="correct"
                            class="@if ($errors->has('correct')) text-danger @else text-primary @endif"
                            autocomplete="off">
                        <label for="input" class="control-label">Correct Answer</label><i class="bar"></i>
                        @error('correct') <span class="text-danger font-12">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if($type == 'Essay')
                    
                    @endif

                    <div class="button-container mt-2">
                        <button type="button" class="btn btn-rounded btn-primary" wire:click="submit"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>
                                <i class="fa fa-spinner fa-spin"></i> Loading...
                            </span>
                        </button>


                        <button class="btn btn-sm btn-default" type="button" wire:click="clear">Close</button>

                    </div>

                </form>


            </div>
        </div>
    </div>

    @else

    <div class="col-lg-12">
        <p class="mb-2">Total points : {{ $total_points }}</p>
        @forelse($questions as $question)
        <div class="card mb-2 ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-wrap">{{ ucfirst($question->question) }}</p>
                        @if($question->type != 'E' AND $question->type != 'HO')
                        <span class="badge badge-success"> {{ ucfirst($question->correct) }} </span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        @if(!$openForm)
                        <button class="btn btn-default" type="button" wire:click="$dispatch('edit_question', { id: '{{ $question->id }}', type : '{{ $question->type }}' })">Edit</button>

                        <button class="btn btn-rounded btn-danger" type="button" wire:click="$dispatch('delete_question', { id: '{{ $question->id }}', question: '{{ $question->question }}' })">Delete</button>
                        @endif
                        <p class="mx-2">{{ $question->points }} pts</p>

                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>No Data</p>
        @endforelse

    </div>

    @endif




    <x-modal id="modal_delete" title="Prompt">
        <p>Are you sure you want to delete this ? <br> <b class="q_label"></b></p>
        <button class="btn btn-danger btn-rounded float-end btn-delete" type="button">Yes, Delete</button>
    </x-modal>

    @script
    <script>
        $wire.on('success', (data) => {

            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            });

        })

        $wire.on('error', (data) => {

            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            });

        })

        $wire.on('delete_question', (data) => {
            $('.btn-delete').attr('wire:click', `deleteItem(${data.id})`)
            $('.q_label').text(data.question)

            $('#modal_delete').modal('show')
        })
        $wire.on('close_modal', (data) => {
            $('#modal_delete').modal('hide')
        })
    </script>
    @endscript

</div>