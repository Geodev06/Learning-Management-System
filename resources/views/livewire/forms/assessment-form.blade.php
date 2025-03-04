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

                <x-pythoncompiler />

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