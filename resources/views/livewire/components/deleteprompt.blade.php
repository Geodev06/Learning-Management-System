<div class="container">
    @if(session('error'))
    <x-alert title="Error" message="{{ session('error') }}" type="danger" />
    @endif
    <div class="row">
        <div class="col-lg-12 p-2">
            <form class="forms-sample material-form">

                <h5> Delete {{ $title ?? '' }} </h5>
                <p>
                    Are you sure you want to delete this item? This action cannot be undone.
                </p>


                <div class="button-container float-end mx-2">
                    <button type="button"
                        class="btn btn-rounded btn-danger"
                        wire:click="submit()"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Yes, Delete</span>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-spin"></i> Loading...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>


    @assets
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @endassets

    @script
    <script>
        $wire.on('close_modal', (data) => {


            Swal.fire({
                title: data[0].title,
                text: data[0].message,
                icon: data[0].status
            });

            $('#delete_modal').modal('hide')


        })
    </script>
    @endscript
</div>