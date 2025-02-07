<div class="container">
    @if(session('error'))
    <x-alert title="Error" message="{{ session('error') }}" type="danger" />
    @endif
    <div class="row">
        <div class="col-lg-12 p-2">
            <form class="forms-sample material-form">

                <div class="form-group">
                    <input type="text" required="required" wire:model="title" class="@if ($errors->has('title')) text-danger @else text-primary @endif" autocomplete="off">
                    <label for="input" class="control-label">Title</label><i class="bar"></i>
                    @error('title') <span class="text-danger font-12">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">

                    <textarea name="" wire:model="overview" id="" cols="30" rows="3"></textarea>
                    <label for="input" class="control-label">Module Description</label><i class="bar"></i>
                    @error('overview') <span class="text-danger font-12">{{ $message }}</span> @enderror

                </div>

                <div class="form-group">
                    <input type="number" required="required" wire:model="no_of_lessons" class="@if ($errors->has('no_of_lessons')) text-danger @else text-primary @endif" autocomplete="off">
                    <label for="input" class="control-label">No. of Lessons</label><i class="bar"></i>
                    @error('no_of_lessons') <span class="text-danger font-12">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-12">

                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" wire:model="a_flag" class="form-check-input"> Auditory <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-check col">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" wire:model="v_flag" class="form-check-input"> Visual <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" wire:model="k_flag" class="form-check-input"> Kinesthetic <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" wire:model="r_flag" class="form-check-input"> Reading and Writing <i class="input-helper"></i>
                        </label>
                    </div>
                </div>

                <div class="button-container float-end mx-2">
                    <button type="button"
                        class="btn btn-rounded btn-primary"
                        wire:click="submit('Y')"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Post</span>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-spin"></i> Loading...
                        </span>
                    </button>
                </div>

                <div class="button-container float-end mx-2">
                    <button type="button"
                        class="btn btn-rounded btn-primary"
                        wire:click="submit('N')"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Save as Draft</span>
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

            $('#modal').modal('hide')

          
        })
    </script>
    @endscript
</div>