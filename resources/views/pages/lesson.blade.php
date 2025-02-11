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
                                onclick="window.location.replace('/module-lessons/'+ '{{ base64_encode($module->id) }}')">Back</button>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <h2><b>{{ ucwords($module->title ?? '' ) }}</b> / {{ ucwords($lesson->title ?? '') }}</h2>
                        </div>

                        <div class="col-sm-12">

                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="overview" aria-selected="true">Attachments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#activities" role="tab" aria-selected="false">Activities</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="attachments" role="tabpanel" aria-labelledby="attachments">
                                        <div class="row">
                                            <div class="col-lg-12 ">
                                                <button class="btn btn-sm btn-default float-start" id="btn_add"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal">Upload Attachment
                                                </button>
                                            </div>

                                            <div class="col-lg-12">
                                                <livewire:components.filecards lesson_id="{{ $lesson->id }} " />
                                            </div>
                                       
                                            

                                        </div>

                                        <div class="tab-content tab-content-basic">
                                            <div class="tab-pane fade show" id="activities" role="tabpanel" aria-labelledby="activities">
                                                <div class="row flex-grow">
                                                    <div class="col-lg-12">
                                                        <p>Activities</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <x-footer />
                </div>
            </div>
        </div>

        <!-- Modal component -->
        <x-modal id="modal" title="Attachment">
            <form id="file-upload-form" class="forms-sample" enctype="multipart/form-data">
                <div class="ERROR text-danger font-12"></div>
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ base64_encode($lesson->id) }}">
                    <label for="SELECT_TYPE">Attachment Type</label>
                    <select class="form-select form-select-sm" name="file_type" id="SELECT_TYPE">
                        <option value="PDF">PDF <i class="fas fa-pdf"></i></option>
                        <option value="LINK">LINK</option>
                        <option value="PPT">PPT</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                </div>
                <div class="ppt-label font-12">Note : The System cannot directly Store a .pptx file please upload it to oneDrive and get the embed code and paste in as a link.</div>

                <div class="form-group file-input">
                    <label for="input" class="control-label">File</label><i class="bar"></i>
                    <input type="file" name="file" accept=".pdf" class="file-input @if ($errors->has('file')) text-danger @else text-primary @endif form-control" autocomplete="off">
                </div>

                <!-- Text input field (hidden by default) -->
                <div class="form-group text-input" style="display:none;">
                    <label for="inputText" class="control-label">Enter Link</label><i class="bar"></i>
                    <input type="text" id="inputText" name="inputText" class="form-control" placeholder="Enter your link here">
                </div>

                <div class="button-container">
                    <button type="submit"
                        class="btn btn-rounded btn-primary">Upload

                    </button>
                </div>
            </form>
        </x-modal>



</body>
@include('core.core_js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>


@livewireScripts
<script>
    $(document).ready(function() {
        // Triggered when the select option changes
        $('#SELECT_TYPE').change(function() {
            var selectedType = $(this).val();
            if (selectedType === 'PDF') {
                $('.file-input').attr('accept', '.pdf')
            } else {
                $('.file-input').removeAttr('accept')

            }
            // If PDF or OTHER is selected, show the file input
            if (selectedType === 'PDF' || selectedType === 'OTHER') {
                $('.file-input').show(); // Show file input
                $('.text-input').hide(); // Hide text input


            } else {
                $('.file-input').hide(); // Hide file input
                $('.text-input').show(); // Show text input
            }
            if (selectedType === 'PPT') {
                $('.ppt-label').show()
            } else {
                $('.ppt-label').hide()

            }
        });

   
        $('#SELECT_TYPE').trigger('change');

        $('#file-upload-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this); // Store the form reference

            // Prepare the form data (including file and text input)
            var formData = new FormData(this);

            $.ajax({
                url: '/upload', // Replace this with the appropriate route in your Laravel app
                type: 'POST',
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    if (response.status == 200) {
                        form[0].reset(); // Reset the form
                        $('#modal').modal('hide'); // Hide the modal if needed
                        Swal.fire({
                            title: 'Success',
                            text: 'Attachment has been saved.',
                            icon: 'success'
                        }).then(() => {
                            window.location.reload()
                        });


                    }

                },
                error: function(xhr, status, error) {
                    $('.ERROR').text(xhr.responseJSON.message)
                }
            });
        });

    });
</script>


</html>