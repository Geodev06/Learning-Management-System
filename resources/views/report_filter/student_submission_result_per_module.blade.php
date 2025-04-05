<hr>
<div class="row">
    <p class="card-title">Report Filter</p>
    <form action="{{ route('generate') }}" id="report-form" method="post">
        @csrf
        <input type="hidden" name="report_code" value="{{ $report_code }}">

        <div class="form-group w-100">
            <label>Module</label>

            <select class="module" style="width: 100%" placeholder="Select Module">
            </select>
            <span id="module-error" class="text-danger error font-12"></span>

        </div>

        <div class="form-group w-100">
            <label>Student</label>

            <select class="student" style="width: 100%" placeholder="Select Student">
            </select>
            <span id="student-error" class="text-danger error font-12"></span>

        </div>

        <button class="btn btn-primary" type="submit">GENERATE <i class="menu-icon mdi mdi-file-document"></i></button>
    </form>
</div>


<script>
    $(document).ready(function(e) {

        // Initialize the module selectize control
        var module_select = $('.module').selectize({
            valueField: 'value', // Value field for the options
            labelField: 'text', // Text to display in the dropdown
            options: []
        });
        var moduleControl = module_select[0].selectize;
        var student_select = $('.student').selectize({
            valueField: 'value', // Value field for the options
            labelField: 'text', // Text to display in the dropdown
            options: []
        });

        var studentControl = student_select[0].selectize;

        $.get("{{ route('module_list') }}", function(res) {
            studentControl.clearOptions();
            moduleControl.clearOptions()
            moduleControl.addOption(res); // Adding options to the Selectize dropdown
            moduleControl.refreshOptions(); // Refresh to update the dropdown
        });

        moduleControl.on('change', function(value) {
            console.log(value)
            $.get("{{ route('student_list') }}", {
                module_id: value
            }, function(res) {
                studentControl.clearOptions();
                studentControl.addOption(res);
                studentControl.refreshOptions(); // Refresh to update the dropdown
            });
        });

        $('#report-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            var formData = new FormData(this); // Use this to create FormData from the form directly
            formData.append('module', moduleControl.getValue());
            formData.append('student', studentControl.getValue());
            $('.error').text('')

            // Call loading function
            loading();

            // Perform the AJAX request
            $.ajax({
                url: 'generate', // Replace with the URL you want to send the request to
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content-type (important for FormData)
                success: function(response) {
                    stop_loading();

                    if (response.pdf_content) {
                        const byteCharacters = atob(response.pdf_content);
                        const byteArrays = [];

                        for (let offset = 0; offset < byteCharacters.length; offset += 1024) {
                            const slice = byteCharacters.slice(offset, offset + 1024);
                            const byteNumbers = new Array(slice.length);
                            for (let i = 0; i < slice.length; i++) {
                                byteNumbers[i] = slice.charCodeAt(i);
                            }
                            byteArrays.push(new Uint8Array(byteNumbers));
                        }

                        const blob = new Blob(byteArrays, {
                            type: 'application/pdf'
                        });

                        const blobUrl = URL.createObjectURL(blob);

                        window.open(blobUrl, '_blank');
                    } else {
                        console.error('Error generating PDF');
                    }
                },
                error: function(xhr, status, error) {
                    stop_loading();

                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        console.error(field + ': ' + messages.join(', '));
                        let errorMessages = messages.join(', ');
                        let errorElement = $('#' + field + '-error');
                        if (errorElement.length) {
                            // Display the error messages inside the error element
                            errorElement.text(errorMessages).show();
                        }
                    });

                }
            });
        });

    })
</script>