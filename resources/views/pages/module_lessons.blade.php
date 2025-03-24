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


                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#lessons" role="tab" aria-controls="lessons" aria-selected="true">Lessons</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#takers" role="tab" aria-selected="false">Enrollees</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#access" role="tab" aria-selected="false">Access</a>

                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#others" role="tab" aria-selected="false">Others</a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="lessons" role="tabpanel" aria-labelledby="lessons">
                                        <div class="row">
                                            @forelse($lessons as $lesson)
                                            <div class="col-sm-12 mb-4">
                                                <div class="card">
                                                    <div class="card-body d-flex flex-column">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="cursor-pointer text-primary" data-link="{{ route('manage_lessons', [base64_encode($module->id), base64_encode($lesson->id)]) }}">{{ $lesson->title }}</h4>
                                                            <livewire:components.lesson-toggle-button lesson_id="{{ $lesson->id }}" />
                                                        </div>
                                                        <p class="font-12">{{ $lesson->desc ?? '' }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-lg-12">
                                                <p>No Lessons</p>
                                            </div>
                                            @endforelse
                                        </div>

                                    </div>

                                    <div class="tab-content tab-content-basic">

                                        <div class="tab-pane fade show" id="takers" role="tabpanel" aria-labelledby="takers">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <livewire:tables.enrollees-table module_id="{{ $module->id }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content tab-content-basic">

                                        <div class="tab-pane fade show" id="access" role="tabpanel" aria-labelledby="access">
                                            <div class="row ">
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <form class="forms-sample " data-action=""="{{ route('save_module_access', $module->id) }}" method="post">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-cotent-between align-items-center">
                                                                    <div class="form-group w-100">
                                                                        @csrf
                                                                        <label>Only Access by</label>
                                                                        <select name="org_code" style="width: 100%;" multiple="multiple" class="js-example-basic-multiple">
                                                                            @forelse($orgs as $org)
                                                                            <option value="{{ $org->org_code }}" {{ in_array($org->org_code, $saved_orgs) ? 'selected' : '' }}>
                                                                                {{ $org->name }}
                                                                            </option>
                                                                            @empty
                                                                            <option value="" disabled>No organizations available</option>
                                                                            @endforelse
                                                                        </select>


                                                                    </div>

                                                                    <button type="button"
                                                                        class="btn-save-access btn btn-rounded my-auto mx-2 text-white btn-primary"> Save
                                                                    </button>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content tab-content-basic">

                                        <div class="tab-pane fade show" id="others" role="tabpanel" aria-labelledby="others">
                                            <div class="row card">
                                                <div class="col-lg-6 card-body col-md-6 col-sm-4">
                                                    <form id="form_upload" class="forms-sample">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>File upload</label>
                                                            <input type="file" name="file" class="form-control" id="file_input" accept="image/*">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                                    @if($module->bg_image)
                                                    <p>Background image : </p>

                                                    <img id="profile_image" src="{{ asset($module->bg_image) }}" alt=" image" style="max-width :100%; width:100%; max-height:100px" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<script>
    $('.row').on('click', '.cursor-pointer', function(e) {
        window.location.replace(this.dataset.link)
    })

    $('.js-example-basic-multiple').select2({
        placeholder: 'Select an organization',
        allowClear: true // Optional: allows clearing the selection
    });

    $('.btn-save-access').click(function() {
        // Get the selected values from the dropdown
        var selectedValues = $('.js-example-basic-multiple').val();

        // Perform AJAX request to send selected values to the server
        loading()
        $.ajax({
            url: "{{ route('save_module_access', $module->id) }}", // Set the action route
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}", // CSRF token for security
                selected_values: selectedValues, // Send the selected items
            },
            success: function(response) {
                // Handle success response
                stop_loading()
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log("An error occurred: " + error);
                stop_loading()

            }
        });
    });
</script>

<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

<script>
    // Adding event listener for file change
    document.getElementById('file_input').addEventListener('change', function(e) {
        var formData = new FormData();
        formData.append('file', e.target.files[0]); // Appending the selected file
        formData.append('_token', "{{ csrf_token() }}"); // Appending CSRF token
        formData.append('module_id', "{{ $module->id }}")

        // Send the data using AJAX
        $.ajax({
            url: "{{ route('module_bg_upload') }}", // Route to the controller function
            type: 'POST',
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set content type
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: 'File has been uploaded.',
                        icon: 'success'
                    }).then(() => {
                        // Update the image displaye

                        console.log(response)
                        document.getElementById('profile_image').src = `{{ asset('') }}${response.file_path}`;

                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'File upload failed.',
                        icon: 'error'
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error',
                    text: response.responseText,
                    icon: 'error'
                });
            }
        });
    });
</script>


@livewireScripts

@scripts

</html>