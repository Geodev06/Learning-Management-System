<div class="container-fluid p-0">
    <div class="row no-gutters h-100">
        <div class="col-lg-6 p-0"
            style="background: url('https://www.businessinsider.in/photo/53672539/This-is-what-makes-Simplilearn-one-of-the-most-effective-Education-Startups-in-recent-times.jpg'); background-size:cover;">
        </div>

        <div class="col-lg-6 p-0">
            <div class="card" style="min-height: 100vh; padding:10%">
                <div class="card-body mt-5 py-5">
                    <h3 class="text-primary">Learning Management System</h3>
                    <p class="card-description">Welcome! Please fill out the form below to sign up. It only takes a few moments to get started. </p>

                    @if(session('success'))
                    <x-alert title="success" message="{{ session('success') }}" type="success" />
                    @endif


                    <form class="forms-sample material-form">

                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <input type="text" required="required" wire:model="first_name" class="@if ($errors->has('first_name')) text-danger @else text-primary @endif" autocomplete="off">
                                <label for="input" class="control-label">First name</label><i class="bar"></i>
                                @error('first_name') <span class="text-danger font-12">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" wire:model="middle_name" class="@if ($errors->has('middle_name')) text-danger @else text-primary @endif" autocomplete="off">
                                <label for="input" class="control-label">Middle name</label><i class="bar"></i>
                                @error('middle_name') <span class="text-danger font-12">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <input type="text" required="required" class="@if ($errors->has('last_name')) text-danger @else text-primary @endif" wire:model="last_name" autocomplete="off">
                                <label for="input" class="control-label">Last name</label><i class="bar"></i>
                                @error('last_name') <span class="text-danger font-12">{{ $message }}</span> @enderror

                            </div>
                        </div>

                        <div class="form-group mt-0">
                            <input type="text" required="required" class="@if ($errors->has('email')) text-danger @else text-primary @endif" wire:model="email" autocomplete="off">
                            <label for="input" class="control-label">Email address</label><i class="bar"></i>
                            @error('email') <span class="text-danger font-12">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group">
                            <input type="password" required="required" class="@if ($errors->has('password')) text-danger @else text-primary @endif" wire:model="password" autocomplete="off">
                            <label for="input" class="control-label">Password</label><i class="bar"></i>
                            @error('password') <span class="text-danger font-12">{{ $message }}</span> @enderror

                        </div>

                        <div class="form-group">
                            <input type="password" required="required" class="@if ($errors->has('password')) text-danger @else text-primary @endif" wire:model="password_confirmation" autocomplete="off">
                            <label for="input" class="control-label">Confirm Password</label><i class="bar"></i>
                        </div>

                        <div class="button-container">
                            <button type="button"
                                class="btn btn-rounded btn-success"
                                wire:click="submit"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Sign up</span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Loading...
                                </span>
                            </button>
                        </div>


                        <div style="font-size: small;" class="text-left mt-4 fw-light"> Already have an account? <a href="{{ route('login') }} " wire:navigate class="text-primary">Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>