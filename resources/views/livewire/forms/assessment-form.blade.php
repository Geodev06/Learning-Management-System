<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-body p-4">


                @if($type == 'MC')

                @include('partials.mc_form')

                @endif


                @if($type == 'I')

                @include('partials.i_form')

                @endif

                @if($type == 'E')

                @include('partials.e_form')

                @endif

                @if($type == 'HO')

                @include('partials.ho_form')

                @endif

                @if($type == 'HO')

                <div class="col-lg-12">
                    <p>Choose Environment</p>
                </div>
                <div class="d-flex">
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('python') ) }}">Python</a>
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('js') ) }}">JS</a>
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('c#') ) }}">C#</a>
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('java') ) }}">Java</a>
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('php') ) }}">PHP</a>
                    <a class="mx-2 btn btn-md btn-primary text-white" target="_blank" href="{{ route('ide', encrypt('sqlite') ) }}">SQLite</a>


                </div>

                @endif

                @include('partials.assessment_buttons')


            </div>
        </div>
    </div>

    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>\

    @endassets

    @script
    <script>
        $wire.on('success', (data) => {

            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            }).then(function() {
                window.location.replace("{{ route('learn_lesson', ['module_id'=> encrypt($module_id), 'lesson_id'=> encrypt($lesson_id)]) }}");
            });

        })
    </script>
    @endscript
</div>