@php
$questionNumber = 1; // Reset question number for each section
@endphp

@forelse($hands_on as $question)
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


                    <div class="form-group">

                        <textarea name="" required="required" wire:model="answers.question_{{ $question->id }}" id="question_{{ $question->id }}" class="@if ($errors->has('answers.question_{{ $question->id }}')) text-danger @else text-primary @endif" autocomplete="off" cols="30" rows="25"></textarea>
                        <label for="input" class="control-label">Your Code here</label><i class="bar"></i>
                        @if ($errors->has('answers.' . 'question_'.$question->id))
                        <span class="text-danger font-12">Field is required.</span>
                        @endif
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