<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

                        @if(Auth::user()->role == 'ADMIN')
                        @include('partials.admin_dashboard')
                        @endif

                        @if(Auth::user()->role == 'STUDENT')
                        @include('partials.student_dashboard')
                        @endif

                        @if(Auth::user()->role == 'TEACHER')
                        @include('partials.teacher_dashboard')
                        @endif
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


</html>