<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment/Projects</title>
    @include('core.core_css')

    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
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
                        <h4 class="mb-3">Assignment/Projects</h4>
                        <div class="col-sm-12 mb-4">
                            <a class="btn  btn-primary float-end"
                                href="{{ route('assignments_and_projects') }}">Back</a>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-title">Assignment/Project</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <form class="forms-sample material-form " id="form_task">

                                                @csrf
                                                <input type="hidden" name="id" value="{{ isset($data->id) ? encrypt($data->id) : '' }}">
                                                <div class="form-group ">
                                                    <input type="text" required="required" value="{{ $data->title ?? '' }}" name="title" class="text-primary " autocomplete="off">
                                                    <label for="input" class="control-label">Title</label><i class="bar"></i>
                                                    <span class="error-title error text-danger font-12"></span>

                                                </div>

                                                <div class="mb-5">
                                                    <p class="text-dark "><b>Instructions</b></p>
                                                    <div class="error-instructions error text-danger font-12"></div>
                                                    <div id="editor">
                                                    </div>

                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-lg-2">
                                                        <p>Type</p>
                                                        <div class="d-flex">
                                                            <input type="radio" id="radio-a" value="A" name="type" aria-label="Assignment" data-labelauty="Assignment"
                                                                {{ isset($data->type) ? $data->type == 'A' ? 'checked' : '' : 'checked' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                            <input type="radio" id="radio-p" value="P" name="type" aria-label="Project" data-labelauty="Project"
                                                                {{ isset($data->type) ? $data->type == 'P' ? 'checked' : '' : '' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                        </div>
                                                        <span class="error-type error text-danger font-12"></span>

                                                    </div>

                                                    <div class="col-lg-4">
                                                        <p>Modality</p>
                                                        <div class="d-flex">
                                                            <input type="radio" id="modality-a" value="A" name="modality" aria-label="Auditory" data-labelauty="Auditory"
                                                                {{ isset($data->modality) ? $data->modality == 'A' ? 'checked' : '' : '' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                            <input type="radio" id="modality-v" value="V" name="modality" aria-label="Visual" data-labelauty="Visual"
                                                                {{ isset($data->modality) ? $data->modality == 'V' ? 'checked' : '' : '' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                            <input type="radio" id="modality-k" value="K" name="modality" aria-label="Kinesthetics" data-labelauty="Kinesthetics"
                                                                {{ isset($data->modality) ? $data->modality == 'K' ? 'checked' : '' : '' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                            <input type="radio" id="modality-R" value="R" name="modality" aria-label="Reading and Writing" data-labelauty="Reading and Writing"
                                                                {{ isset($data->modality) ? $data->modality == 'R' ? 'checked' : '' : 'checked' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                        </div>
                                                        <span class="error-modality error text-danger font-12"></span>

                                                    </div>

                                                    <div class="col-lg-4">
                                                        <p>Submission Type</p>
                                                        <div class="d-flex">
                                                            <input type="radio" id="modality-i" value="I" name="submission_type" aria-label="Individual" data-labelauty="Individual"
                                                                {{ isset($data->submission_type) ? $data->submission_type == 'I' ? 'checked' : '' : 'checked' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                            <input type="radio" id="modality-g" value="G" name="submission_type" aria-label="Groupings" data-labelauty="Groupings"
                                                                {{ isset($data->submission_type) ? $data->submission_type == 'G' ? 'checked' : '' : '' }}
                                                                {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-3 fs-5">
                                                    <input type="datetime-local" id="deadline" name="deadline" value="{{ $data->deadline ?? '' }}" required class="text-primary" autocomplete="off">
                                                    <label for="deadline" class="control-label">Due date</label>
                                                    <i class="bar"></i>
                                                    <br>
                                                    <span class="error-deadline error text-danger font-12"></span>
                                                </div>

                                                <hr>

                                                <div class="card-title">Respondents</div>
                                                <div class="col-lg-4">
                                                    <p>Load Students</p>
                                                    <div class="d-flex">
                                                        <input type="radio"  {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} id="BS_IT" value="BS_IT" name="load" aria-label="BS IT" data-labelauty="BS IT" />
                                                        <input type="radio"  {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} id="BS_CS" value="BS_CS" name="load" aria-label="BS CS" data-labelauty="BS CS" />
                                                        <input type="radio"  {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} id="ALL" value="ALL" name="load" aria-label="ALL" data-labelauty="ALL" checked />

                                                    </div>
                                                </div>

                                                <div class="form-group w-100">
                                                    <select name="student_id"  {{ isset($data->posted_flag) ? $data->posted_flag == 'Y' ? 'disabled' : '' : '' }} style="width: 100%;" multiple="multiple" class="respondents">
                                                    </select>
                                                </div>

                                                <div class="button-container float-end mt-2">

                                                    @if(isset($data->posted_flag) AND $data->posted_flag == 'Y')
                                                    <button type="submit" data-post_flag="Y" id="btn-post"
                                                        class="btn btn-rounded btn-primary">
                                                        <span>Save Changes</span>
                                                    </button>

                                                    @else

                                                    <button type="submit" data-post_flag="N" id="btn-save"
                                                        class="btn btn-rounded btn-primary">
                                                        <span>Save as Draft</span>
                                                    </button>

                                                    <button type="submit" data-post_flag="Y" id="btn-post"
                                                        class="btn btn-rounded btn-primary">
                                                        <span>Post</span>
                                                    </button>

                                                    @endif


                                                </div>



                                            </form>
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

@include('partials.labelauty')

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>


<script>
    $(document).ready(function(e) {

        const $respondents = $('.respondents');

        $respondents.select2({
            placeholder: 'Select Respondents',
            allowClear: true,
            multiple: true // Ensure multiple selection is enabled
        });

        // Handle input change to load data
        $('input[name="load"]').on('change', function() {
            const selectedValue = $(this).val();

            loading()
            $.get('/load_students', {
                value: selectedValue
            }, function(res) {
                $respondents.empty();

                res.forEach(data => {
                    const newOption = new Option(data.text, data.value, true, true);
                    $respondents.append(newOption);
                });

                $respondents.trigger('change');
                stop_loading()

            });
        });

        if ("{{ isset($data->id) ? 'Y' : 'N' }}" == 'N') {
            $('input[name="load"]').trigger('change')
        } else {
            $.get('/get_saved_participants', {
                value: "{{ isset($data->id) ? $data->id : null }}"
            }, function(res) {
                $respondents.empty();
                res.forEach(data => {
                    const newOption = new Option(data.text, data.value, true, true);
                    $respondents.append(newOption);
                });

                $respondents.trigger('change');
                stop_loading()

            });
        }


        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        let realHTML = $('<textarea />').html("{{ $data->instructions ?? '' }}").text();
        quill.root.innerHTML = realHTML;

        $('#btn-save, #btn-post').on('click', function(e) {
            e.preventDefault();

            var post_flag = $(this)[0].dataset.post_flag
            var type = $('input[name="type"]:checked').val();
            var submission_type = $('input[name="submission_type"]:checked').val();
            var modality = $('input[name="modality"]:checked').val();
            var respondents_values = $respondents.val();

            $('.error').text('')

            var formData = $('#form_task').serialize();

            formData += '&type=' + type + '&submission_type=' + submission_type +
                '&modality=' + modality + '&post_flag=' + post_flag + '&instructions=' + quill.root.innerHTML +
                '&respondents=' + respondents_values


            loading()
            $.ajax({
                url: '/process_task', // Replace with your URL
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            title: response.title,
                            text: response.msg,
                            icon: response.status
                        }).then(() => {
                            window.location.replace("{{ route('assignments_and_projects') }}")
                        });
                    }
                    stop_loading()

                },
                error: function(xhr, status, error) {

                    console.log(xhr)
                    if (xhr.status == 422) {
                        $.each(xhr.responseJSON.errors, function(field, messages) {

                            console.log(field)
                            $('.error-' + field).text(messages[0]);
                        });
                    }
                    stop_loading()
                }
            });
        });

    })
</script>

</html>