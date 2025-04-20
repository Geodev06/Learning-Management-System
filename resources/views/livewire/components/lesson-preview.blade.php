<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    <div class="home-tab">
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="overview" aria-selected="true">Learning Materials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#activities" role="tab" aria-selected="false">Activities</a>
                                </li>

                                @if($module->k_flag == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#play_ground" role="tab" aria-selected="false">Play Ground</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="attachments" role="tabpanel" aria-labelledby="attachments">
                                <div class="row">


                                    <div class="col-lg-12">
                                        <livewire:components.filecards lesson_id="{{ $lesson->id }} " />
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade show " id="activities" role="tabpanel" aria-labelledby="activities">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(!$has_mc)
                                        <button class="btn btn-primary text-white" type="button"
                                            wire:click="$dispatch('open_prompt', { module_id: '{{ encrypt($module->id) }}', lesson_id: '{{ encrypt($lesson->id) }}', type : '{{ encrypt('MC') }}' })">Multiple Choice</button>
                                        @endif

                                        @if(!$has_i)
                                        <button class="btn btn-primary text-white" type="button"
                                            wire:click="$dispatch('open_prompt', { module_id: '{{ encrypt($module->id) }}', lesson_id: '{{ encrypt($lesson->id) }}', type : '{{ encrypt('I') }}' })">Identification</button>
                                        @endif

                                        @if(!$has_e)
                                        <button class="btn btn-primary text-white" type="button"
                                            wire:click="$dispatch('open_prompt', { module_id: '{{ encrypt($module->id) }}', lesson_id: '{{ encrypt($lesson->id) }}', type : '{{ encrypt('E') }}' })">Essay</button>
                                        @endif

                                        @if(!$has_ho)
                                        <button class="btn btn-primary text-white" type="button"
                                            wire:click="$dispatch('open_prompt', { module_id: '{{ encrypt($module->id) }}', lesson_id: '{{ encrypt($lesson->id) }}', type : '{{ encrypt('HO') }}' })">Hands On</button>
                                        @endif
                                    </div>

                                    <div class="col-lg-12">
                                        <p>Activity Checklist</p>

                                        <ul>
                                            @if(!$has_mc)
                                            <li>Multiple Choice <i class="fa fa-exclamation text-danger"></i></li>
                                            @else
                                            <li>Multiple Choice <i class="fa fa-check-circle text-success"></i></li>

                                            @endif

                                            @if(!$has_i)
                                            <li>Identification <i class="fa fa-exclamation text-danger"></i></li>

                                            @else
                                            <li>Identification <i class="fa fa-check-circle text-success"></i></li>

                                            @endif

                                            @if(!$has_e)
                                            <li>Essay <i class="fa fa-exclamation text-danger"></i></li>

                                            @else
                                            <li>Essay <i class="fa fa-check-circle text-success"></i></li>

                                            @endif

                                            @if(!$has_ho)
                                            <li>Hands On <i class="fa fa-exclamation text-danger"></i></li>

                                            @else
                                            <li>Hands On <i class="fa fa-check-circle text-success"></i></li>

                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show " id="play_ground" role="tabpanel" aria-labelledby="play_ground">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>Choose Environment</p>
                                    </div>
                                    <div class="d-flex">
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('python') ) }}">Python</a>
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('js') ) }}">JS</a>
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('c#') ) }}">C#</a>
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('java') ) }}">Java</a>
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('php') ) }}">PHP</a>
                                        <a class="btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('sqlite') ) }}">SQLite</a>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="modal" title="Prompt">
        <p>Are you confident that you are ready to take the assessment for <br> {{ $module->title }} <b>Lesson {{ $lesson->lesson_no }}</b>?</p>
        <p>Once you begin the assessment, you will temporarily lose access to the learning materials to ensure a focused testing environment.
            Please take a moment to confirm that you are fully prepared before proceeding.</p>
        <button class=" btn btn-success btn-rounded btn-take">Let's Go</button>
    </x-modal>
    @script
    <script>
        $wire.on('open_prompt', (payload) => {

            var params = "take_assessment('{{ encrypt($module->id) }}', '{{ encrypt($lesson->id) }}', '" + payload.type + "')";

            console.log(params);
            $('.btn-take').attr('wire:click', params);

            $('#modal').modal('show')
        })
    </script>
    @endscript
</div>