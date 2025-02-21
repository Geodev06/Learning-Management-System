<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-body p-4">
                @php
                $questionNumber = 1; // Reset question number for each section
                @endphp

                @forelse($multiple_choice as $question)
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-2 d-flex bg-primary text-white">
                            <h3 class="my-auto mx-auto"><b>{{ $questionNumber }}.</b> </h3> <!-- Dynamic numbering -->
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-text"><b>{{ $question->question }}</b> </h6>
                                    <span class="badge badge-success font-12">{{ $question->points }} pts</span>
                                </div>


                                @if(sizeof($question->choices) > 0)
                                <div class="row">

                                    @foreach($question->choices as $choice)
                                    <div class="form-check mx-4 col-lg-4 col-md-4 col-sm-12">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="question_{{ $question->id }}" id="question_{{ $question->id }}" value="{{ $choice->value }}">{{ ucfirst($choice->value) }}<i class="input-helper"></i></label>
                                    </div>
                                    @endforeach
                                </div>


                                @endif

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

                <div class="button-container">
                    <button type="button"
                        class="btn btn-rounded btn-primary float-end"
                        wire:click="submit"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Submit Answer</span>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-spin"></i> Loading...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>