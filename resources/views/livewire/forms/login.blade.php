<div class="container-fluid p-0">
    <div class="row no-gutters h-100">
        <div class="col-lg-6 p-0"
            style="background: url('https://www.businessinsider.in/photo/53672539/This-is-what-makes-Simplilearn-one-of-the-most-effective-Education-Startups-in-recent-times.jpg'); background-size:cover;">
        </div>

        <div class="col-lg-6 p-0">
            <div class="card" style="min-height: 100vh; padding:10%">
                <div class="card-body mt-5 py-5">
                    <h3 class="text-primary">Learning Management System </h3>
                    <span class="font-12 text-dark mt-0 mb-4">{{ env('APP_VERSION') }}</span>
                    <p class="card-description mt-2"> Please login to continue </p>

                    @if(session('error'))
                    <x-alert title="Error" message="{{ session('error') }}" type="danger" />
                    @endif

                    @if(session('success_reset'))
                    <x-alert title="Success" message="{{ session('success_reset') }}" type="success" />
                    @endif

                    <form class="forms-sample material-form">
                        <div class="form-group">
                            <input type="text" required="required" wire:model="email"  class="@if ($errors->has('email')) text-danger @else text-primary @endif" autocomplete="off">
                            <label for="input" class="control-label">Email address</label><i class="bar"></i>
                            @error('email') <span class="text-danger font-12">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group">
                            <input type="password" required="required" wire:model="password" class="@if ($errors->has('email')) text-danger @else text-primary @endif" autocomplete="off">
                            <label for="input" class="control-label">Password</label><i class="bar"></i>
                            @error('password') <span class="text-danger font-12">{{ $message }}</span> @enderror

                        </div>

                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input"> Keep me signed in <i class="input-helper"></i></label>
                            </div>
                            <a href="{{ route('password.request') }}" class="auth-link text-black" style="font-size: small;">Forgot password?</a>
                        </div>
                        <div class="button-container">
                            <button type="button"
                                class="btn btn-rounded btn-primary"
                                wire:click="submit"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Sign In</span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Loading...
                                </span>
                            </button>
                        </div>
                        <div style="font-size: small;" class="text-left mt-4 fw-light"> Don't have an account? <a href="{{ route('register') }} " wire:navigate class="text-primary">Create</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>