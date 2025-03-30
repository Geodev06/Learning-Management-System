<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('core.core_css')

    @livewireStyles
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row no-gutters h-100">
            <div class="col-lg-6 p-0"
                style="background: url('https://www.businessinsider.in/photo/53672539/This-is-what-makes-Simplilearn-one-of-the-most-effective-Education-Startups-in-recent-times.jpg'); background-size:cover;">
            </div>

            <div class="col-lg-6 p-0">
                <div class="card" style="min-height: 100vh; padding:10%">
                    <div class="card-body mt-5 py-5">
                        <h3 class="text-primary">Forgot Password</h3>
                        <p class="card-description"> Please enter email to continue </p>

                        @if(session('status'))
                        <x-alert title="Information" message="{{ session('status') }}" type="info" />
                        @endif

                        <form class="forms-sample material-form" action="{{ route('password.email') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <input type="text" required="required" name="email" class="@if ($errors->has('email')) text-danger @else text-primary @endif" autocomplete="off">
                                <label for="input" class="control-label">Email address</label><i class="bar"></i>
                                @error('email') <span class="text-danger font-12">{{ $message }}</span> @enderror

                            </div>
                            <div class="button-container">
                                <button type="submit"
                                    class="btn btn-rounded btn-primary">
                                    <span >Send Reset Password Link</span>
                                  
                                </button>
                            </div>
                            <div style="font-size: small;" class="text-left mt-4 fw-light"><a href="{{ route('login') }} " wire:navigate class="text-primary">Back to login </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('core.core_js')
@livewireScripts


</html>