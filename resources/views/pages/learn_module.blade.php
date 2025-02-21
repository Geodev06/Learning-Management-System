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

                        <livewire:components.module-header id="{{ $module->id }}" />

                        @forelse($lessons as $lesson)
                        <div class="col-sm-12 mb-2">
                            <div class="card cursor-pointer" data-link="{{ route('learn_lesson', [encrypt($module->id), encrypt($lesson->id)]) }}">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="" >{{ $lesson->title }}</h4>
                                    </div>
                                    <p class="font-12">{{ $lesson->desc ?? '' }}</p>

                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-lg-12 mt-5">
                            <p class="mx-2">No Lessons Available</p>
                        </div>
                        @endforelse
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
<script>
    $('.row').on('click', '.cursor-pointer', function(e) {
        window.location.href = this.dataset.link
    })
</script>

@livewireScripts

@scripts

</html>