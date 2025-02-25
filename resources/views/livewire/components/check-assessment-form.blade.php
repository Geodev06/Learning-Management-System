<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>{{ ucfirst($assessment->creator ?? '' )}}</h2>
                    <p class="font-12">Submitted by:</p>
                    <p class="font-12">Submitted date : {{ $assessment->created_at }}</p>

                </div>

                <div>
                    <p>Activity type :</p>
                    <p class="font-12">
                        @if($assessment->type == 'MC')
                        <span class="badge badge-primary">Multiple Choice</span>
                        @elseif($assessment->type == 'I')
                        <span class="badge badge-danger">Identification</span>

                        @elseif($assessment->type == 'E')
                        <span class="badge badge-success">Essay</span>

                        @else
                        <span class="badge badge-dark">Hands On</span>

                        @endif

                    </p>
                </div>

                <div>
                    <p>Module Name : <b>{{ ucfirst($assessment->module_name) }}</b>
                    <p>
                    <p>Lesson no. : <b>{{ $assessment->lesson_no }}</b>
                    <p>
                </div>

                <div>
                    <p>Score : {{ $assessment->checked_flag == 'Y' ? $assessment->points : '--'  }} /{{ $assessment->total_points }} </p>
                    <p>Grade : {{ $assessment->checked_flag == 'Y' ? $assessment->grade : '--'  }}</p>
                    <p>Mark : {{ $assessment->checked_flag == 'Y' ? $assessment->mark : '--'  }}</p>


                </div>
            </div>
        </div>
    </div>

    @if($assessment->checked_flag == 'N' AND (Auth::user()->role == 'ADMIN' OR Auth::user()->role == 'TEACHER') )
    <div class="card mt-2">
        <div class="card-body">

            @php
            $questionNumber = 1; // Reset question number for each section
            @endphp

            @forelse($assessment_details as $question)
            <div class="card mb-3 shadow-sm">
                <div class="row g-0">

                    @if ($errors->has('answers.' . 'question_'.$question->id))
                    <div class="col-md-2 d-flex bg-danger text-white">
                        <h3 class="my-auto mx-auto"><b>{{ $questionNumber }}.</b> </h3> <!-- Dynamic numbering -->
                    </div>
                    @else
                    <div class="col-md-2 d-flex bg-primary text-white">
                        <h3 class="my-auto mx-auto"><b>{{ $questionNumber }}.</b> </h3> <!-- Dynamic numbering -->

                    </div>
                    @endif
                    <div class="col-md-10">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-text"><b>{{ $question->question }}</b> </h6>
                                <span class="badge badge-success font-12">{{ $question->points }} pts</span>
                            </div>



                            <form class="forms-sample material-form">
                                <div class="d-flex justify-content-between">
                                    <div style="max-width: 80%;">
                                        <p class="">{{ ucfirst($assessment->creator) }} Answer:</p>
                                        @if($assessment->type == 'E')
                                        <p><i>{{ $question->user_answer }}</i></p>
                                        @endif

                                        @if($assessment->type == 'HO')
                                        <pre>
                                        {{ $question->user_answer }}
                                        </pre>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" max="{{ $question->points }}" required="required" wire:model="answers.question_{{ $question->id }}" id="question_{{ $question->id }}" class="@if ($errors->has('answers.question_{{ $question->id }}')) text-danger @else text-primary @endif" autocomplete="off">
                                        <label for="input" class="control-label">Enter Points</label><i class="bar"></i>
                                        @if ($errors->has('answers.' . 'question_'.$question->id))
                                        <span class="text-danger font-12">Field Value is not Valid.</span>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @php
            $questionNumber++; // Increment the question number
            @endphp
            @empty
            <p>No questions found in this section.</p>
            @endforelse


            @if(Auth::user()->role == 'ADMIN' OR Auth::user()->role == 'TEACHER')
            <div class="button-container float-end">
                <button type="button"
                    class="btn btn-rounded btn-primary"
                    wire:click="submit"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Finish Checking</span>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-spin"></i> Saving...
                    </span>
                </button>
            </div>
            @endif

        </div>
    </div>
    @else
    <div class="card mt-2">
        <div class="card-body">

            @php
            $questionNumber = 1; // Reset question number for each section
            @endphp

            @forelse($assessment_details as $question)
            <div class="card mb-3 shadow-sm">
                <div class="row g-0">

                    @if ($errors->has('answers.' . 'question_'.$question->id))
                    <div class="col-md-2 d-flex bg-danger text-white">
                        <h3 class="my-auto mx-auto"><b>{{ $questionNumber }}.</b> </h3> <!-- Dynamic numbering -->
                    </div>
                    @else
                    <div class="col-md-2 d-flex bg-primary text-white">
                        <h3 class="my-auto mx-auto"><b>{{ $questionNumber }}.</b> </h3> <!-- Dynamic numbering -->

                    </div>
                    @endif
                    <div class="col-md-10">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-text"><b>{{ $question->question }}</b> </h6>
                                <span class="badge badge-primary font-12">{{ $question->points }} pts</span>
                            </div>



                            <form class="forms-sample material-form">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="">{{ ucfirst($assessment->creator) }} Answer:</p>
                                      
                                        @if($assessment->type == 'HO')
                                        <pre>
                                        {{ $question->user_answer }}
                                        </pre>

                                        @else
                                        
                                        @if($assessment->type == 'MC' || $assessment->type == 'I')
                                       <p> {{ $question->user_answer }} </p>
                                        <p>Correct answer : {{ $question->correct_answer }} </p>
                                        @else
                                        {{ $question->user_answer }}
                                        <p></p>
                                        @endif
                                        @endif
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @php
            $questionNumber++; // Increment the question number
            @endphp
            @empty
            <p>No questions found in this section.</p>
            @endforelse

        </div>
    </div>
    @endif

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
            })

        })
    </script>
    @endscript
</div>