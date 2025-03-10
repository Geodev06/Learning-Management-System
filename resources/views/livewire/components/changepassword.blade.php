<div class="card h-100 border">
    <div class="card-body">
        <b>Password settings</b>
        <p class="text-muted">To maintain the security of your account, please update your password settings. Ensure your new password is unique, strong, and not shared across other accounts.</p>
        <form class="forms-sample material-form">

            <div class="form-group">
                <input type="password" required="required" wire:model="old_password" class="@if ($errors->has('old_password')) text-danger @else text-primary @endif" autocomplete="off">
                <label for="input" class="control-label">Current Password</label><i class="bar"></i>
                @error('old_password') <span class="text-danger font-12">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <input type="password" required="required" wire:model="password" class="@if ($errors->has('password')) text-danger @else text-primary @endif" autocomplete="off">
                <label for="input" class="control-label">New Password</label><i class="bar"></i>
                @error('password') <span class="text-danger font-12">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <input type="password" required="required" wire:model="password_confirmation" class="@if ($errors->has('password_confirmation')) text-danger @else text-primary @endif" autocomplete="off">
                <label for="input" class="control-label">Confirm Password</label><i class="bar"></i>
                @error('password') <span class="text-danger font-12">{{ $message }}</span> @enderror
            </div>


            <div class="button-container float-end mx-2">
                <button type="button"
                    class="btn btn-rounded btn-primary"
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