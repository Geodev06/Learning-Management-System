<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
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
                        <h3 class="text-primary">Email Verification</h3>
                        <p class="card-description"> Please verify your email to continue. </p>

                        @if(session('status'))
                        <x-alert title="Error" message="{{ session('status') }}" type="danger" />
                        @endif

                        @if(session('message'))
                        <x-alert title="Information" message="{{ session('message') }}" type="info" />
                       
                        @endif

                        <form class="forms-sample material-form" action="{{ route('verification.send') }}" method="post">
                            <div class="form-group">
                                <div class="fs-6 text-success">
                                    {{ strtolower(Auth::user()->email ?? '') }}
                                    <hr>
                                    <p class="font-12">{{ strtolower(Auth::user()->updated_at ?? '') }}</p>

                                </div>
                            </div>
                            @csrf
                            <div class="button-container">
                                <button type="submit"
                                    class="btn btn-rounded btn-primary">
                                    <span wire:loading.remove>Send Verification Link</span>

                                </button>
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