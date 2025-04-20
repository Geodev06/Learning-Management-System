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
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="overview" aria-selected="true">Attachments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#activities" role="tab" aria-selected="false">Activities</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link " id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-selected="false">Submissions</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show " id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-lg-12 ">
                                                <x-tablesubmissionlesson :id="$module->id" :lesson="$lesson->id" />
                                            </div>


                                        </div>
                                    </div>

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
                                    </div>
                                    <div class="tab-pane fade show " id="activities" role="tabpanel" aria-labelledby="activities">
                                        <div class="row row-action">
                                            <div class="col-lg-12 ">
                                                <button data-module_id="{{ base64_encode($module->id) }}" data-lesson_id="{{ base64_encode($lesson->id) }}" data-type="{{ encrypt('MC') }}" class="btn btn-lg btn-primary text-white btn-action">Multiple choice</button>
                                                <button data-module_id="{{ base64_encode($module->id) }}" data-lesson_id="{{ base64_encode($lesson->id) }}" data-type="{{ encrypt('I') }}" class="btn btn-lg btn-primary text-white btn-action">Identification</button>
                                                <button data-module_id="{{ base64_encode($module->id) }}" data-lesson_id="{{ base64_encode($lesson->id) }}" data-type="{{ encrypt('E') }}" class="btn btn-lg btn-primary text-white btn-action">Essay</button>
                                                <button data-module_id="{{ base64_encode($module->id) }}" data-lesson_id="{{ base64_encode($lesson->id) }}" data-type="{{ encrypt('HO') }}" class=" btn btn-lg btn-primary text-white btn-action">Hands-on</button>
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
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ base64_encode($lesson->id) }}">
                    <label for="SELECT_TYPE">Attachment Type</label>
                    <select class="form-select form-select-sm" name="file_type" id="SELECT_TYPE">
                        <option value="PDF">PDF</option>
                        <option value="LINK">LINK</option>
                        <option value="PPT">PPT</option>
                        <option value="AUDIO">AUDIO</option>
                        <option value="VIDEO">VIDEO</option>
                        <option value="IMAGES">IMAGES</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                </div>

                <div class="form-group">

                    <label for="input" class="control-label">Caption <span class="text-danger">*</span></label><i class="bar"></i>
                    <input type="text" name="caption" class="form-control" placeholder="Enter Caption here" autocomplete="off">
                    <div class="caption-error text-danger font-12"></div>

                </div>

                <div class="ppt-label font-12">Note : The System cannot directly Store a .pptx file please upload it to oneDrive and get the embed code and paste in as a link.</div>

                <div class="form-group file-input">

                    <label for="input" class="control-label">File</label><i class="bar"></i>
                    <input type="file" name="file[]" accept=".pdf" multiple class="file-input @if ($errors->has('file')) text-danger @else text-primary @endif form-control" autocomplete="off">
                    <div class="file-error text-danger font-12"></div>

                </div>

                <!-- Text input field (hidden by default) -->
                <div class="form-group text-input" style="display:none;">
                    <label for="inputText" class="control-label">Enter Link</label><i class="bar"></i>

                    <input type="text" id="inputText" name="inputText" class="form-control" placeholder="Enter your link here">
                    <div class="inputText-error text-danger font-12"></div>

                </div>

                <div class="button-container">
                    <button type="submit"
                        class="btn btn-rounded btn-submit btn-primary">Upload

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

            // Handle the file input's accept attribute based on the selected type
            if (selectedType === 'PDF') {
                $('.file-input').attr('accept', '.pdf'); // Accept only PDF files
                $('.file-input').attr('multiple', 'true'); // Accept only PDF files
                $('.file-input').attr('name', 'file[]'); // Accept only PDF files


            } else if (selectedType === 'OTHER') {
                $('.file-input').removeAttr('accept'); // Remove file type restrictions for 'OTHER'
            } else {
                $('.file-input').removeAttr('accept'); // Remove file type restrictions for other types
                $('.file-input').removeAttr('multiple'); // Accept only PDF files
                $('.file-input').attr('name', 'file'); // Accept only PDF files
            }

            if (selectedType === 'VIDEO' || selectedType === 'PDF') {
                $('.file-input').attr('multiple', 'true'); // Accept only PDF files
                $('.file-input').attr('name', 'file[]'); // Accept only PDF files
            } else {
                $('.file-input').removeAttr('multiple'); // Accept only PDF files
                $('.file-input').attr('name', 'file'); // Accept only PDF files
            }

            // Show/hide the file input and text input based on the selected type
            if (selectedType === 'PDF' ||
                selectedType === 'OTHER' ||
                selectedType === 'VIDEO' ||
                selectedType === 'AUDIO' ||
                selectedType === 'IMAGES') {
                $('.file-input').show(); // Show file input
                $('.text-input').hide(); // Hide text input
            } else {
                $('.file-input').hide(); // Hide file input
                $('.text-input').show(); // Show text input
            }

            // Show/hide PPT label based on selected type
            if (selectedType === 'PPT') {
                $('.ppt-label').show();
            } else {
                $('.ppt-label').hide();
            }

        });

        // Trigger change on page load to apply initial state
        $('#SELECT_TYPE').trigger('change');

        // Handle form submission for file upload
        $('#file-upload-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this); // Store the form reference

            // Prepare the form data (including file and text input)
            var formData = new FormData(this);

            loading()
            $('.caption-error').text('')
            $('.file-error').text('')

            $.ajax({
                url: '/upload', // Replace with the correct route in your Laravel app
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
                            window.location.reload();
                        });
                    }
                    stop_loading()

                },
                error: function(xhr, status, error) {
                    $('.ERROR').text(xhr.responseJSON.message);

                    if (xhr.status == 413) {
                        $('.file-error').text(xhr.statusText + " Max. of 40MB. per request.");
                    }

                    if (xhr.status == 422) {
                        $.each(xhr.responseJSON.errors, function(field, messages) {
                            // Here field is the name of the field and messages is an array of validation errors for that field
                            // For each field, display the errors
                            var errorMessage = messages.join(', '); // Combine multiple errors into one string

                            // Append the error message for each field to the respective HTML element (you can modify the selector to match your field)
                            $('.' + field + '-error').text(errorMessage); // Assuming you have an element with ID like "field_name-error"
                        });
                    }


                    stop_loading()

                }


            });
        });


        $('.row-action').on('click', '.btn-action', function(e) {
            var module_id = $(this).data('module_id');
            var lesson_id = $(this).data('lesson_id');
            var type = $(this).data('type');

            // Replace the placeholders in the URL template with actual values
            var url_link = "{{ route('manage_activities', ['module_id' => ':module_id', 'lesson_id' => ':lesson_id', 'type' => ':type']) }}";
            url_link = url_link.replace(':module_id', module_id)
                .replace(':lesson_id', lesson_id)
                .replace(':type', type);

            window.location.replace(url_link)



        })

    });
</script>



</html>