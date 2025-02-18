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
                                onclick="window.location.replace('/manage_lessons/'+ '{{ base64_encode($module->id) }}' + '/{{ base64_encode($lesson->id) }}')">Back</button>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <h2><b>{{ ucwords($module->title ?? '' ) }}</b> / {{ ucwords($lesson->title ?? '') }} / {{ $type }}</h2>
                        </div>

                        <div class="col-sm-12">
                          <livewire:forms.question-form module_id="{{  $module->id }}" lesson_id="{{ $lesson->id }}" type="{{ $type }}" />
                        </div>

                    </div>
                    <x-footer />
                </div>
            </div>
        </div>

      



</body>
@include('core.core_js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

@livewireScripts
<script>
    $(document).ready(function() {
  
    });
</script>



</html>