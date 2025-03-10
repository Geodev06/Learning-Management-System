<div class="card h-100 border">
    <div class="card-body">
        <b>Personal Information settings</b>

        <p class="text-muted">Please review and update your personal details below. Keeping this information current helps ensure we can provide you with the best service and support.</p>
        <form class="forms-sample material-form">

            <p><b>System email</b></p>
            <p class="text-success">{{ Auth::user()->email }}</p>
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <input type="text" required="required" wire:model="first_name" class="@if ($errors->has('first_name')) text-danger @else text-primary @endif" autocomplete="off">
                    <label for="input" class="control-label">First name</label><i class="bar"></i>
                    @error('first_name') <span class="text-danger font-12">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <input type="text" required="required" wire:model="middle_name" class="@if ($errors->has('middle_name')) text-danger @else text-primary @endif" autocomplete="off">
                    <label for="input" class="control-label">Middle name</label><i class="bar"></i>
                    @error('middle_name') <span class="text-danger font-12">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <input type="text" required="required" wire:model="last_name" class="@if ($errors->has('last_name')) text-danger @else text-primary @endif" autocomplete="off">
                    <label for="input" class="control-label">Last name</label><i class="bar"></i>
                    @error('last_name') <span class="text-danger font-12">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="d-flex ">
                <div class="form-check mx-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" wire:model="gender" value="M" {{ $gender = 'NS' ? 'checked' : '' }}> Male <i class="input-helper"></i></label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" wire:model="gender" value="F"> Female <i class="input-helper"></i></label>
                </div>


            </div>
            @error('gender') <span class="text-danger font-12">{{ $message }}</span> @enderror


            <div class="button-container float-end mx-2 mt-3">
                <button type="button"
                    class="btn btn-rounded btn-primary "
                    wire:click="submit()"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Save</span>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-spin"></i> Loading...
                    </span>
                </button>
            </div>


        </form>

    </div>

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
            });

        })
    </script>
    @endscript
    
</div>