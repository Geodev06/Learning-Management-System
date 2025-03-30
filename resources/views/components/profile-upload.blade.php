<div class="card h-100 border" wire:ignore>
    <div class="card-body">
        <b>Profile Picture Settings</b>

        <p class="text-muted">Make sure your profile picture is up-to-date for a personalized experience. You can upload a new image below to update your profile.</p>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <form id="form_upload" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="file" class="form-control" id="file_input" accept="image/*">
                    </div>
                </form>
            </div>

            @if(Auth::user()->profile)
            <div class="col-lg-6 col-md-6 col-sm-4 d-flex justify-content-center align-items-center">
                <img id="profile_image" src="{{ asset(Auth::user()->profile) }}" alt="Profile image" style="max-width :100px; max-height:100px" />
            </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</div>

<script>
    // Adding event listener for file change
    document.getElementById('file_input').addEventListener('change', function(e) {
        var formData = new FormData();
        formData.append('file', e.target.files[0]); // Appending the selected file
        formData.append('_token', "{{ csrf_token() }}"); // Appending CSRF token

        // Send the data using AJAX
        $.ajax({
            url: "{{ route('profile_upload') }}", // Route to the controller function
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



                        document.getElementById('profile_image').src =  response.file_path;
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