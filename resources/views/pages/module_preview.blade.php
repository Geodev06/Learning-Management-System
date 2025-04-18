<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($module->title) ?? '' }}</title>
    @include('core.core_css')

    @livewireStyles
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <x-nav />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <x-sidenav />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <h4 class="mb-3">Learning Module</h4>
                        <div class="col-lg-12">
                            <button onclick="window.history.back()" class="float-end btn btn-primary  mb-2">Back</button>
                        </div>


                        <livewire:components.module-preview id="{{ $module->id }} " />

                        <div class="d-flex">
                            @forelse($module->access as $access)
                            <p class="float-end m-3 mx-1">{{ $access->name ?? '' }} | </p>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


</body>
@include('core.core_js')


@livewireScripts

@scripts

</html>