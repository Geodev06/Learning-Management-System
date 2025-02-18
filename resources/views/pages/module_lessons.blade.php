<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Lessons</title>
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
                        <h4>Lesson Management</h4>
                        <div class="col-sm-12 mb-4">
                            <button class="btn btn-sm btn-primary float-end"
                                onclick="window.location.replace('/modules')">Back</button>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <h2><b>{{ ucwords($module->title) }}</b></h2>
                        </div>
                        @forelse($lessons as $lesson)
                        <div class="col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="cursor-pointer" data-link="{{ route('manage_lessons', [base64_encode($module->id), base64_encode($lesson->id)]) }}">{{ $lesson->title }}</h4>
                                        <livewire:components.lesson-toggle-button lesson_id="{{ $lesson->id }}" />
                                    </div>
                                    <p class="font-12">{{ $lesson->desc ?? '' }}</p>

                                </div>
                            </div>
                        </div>
                        @empty

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
        window.location.replace(this.dataset.link)
    })
</script>



@livewireScripts

@scripts

</html>