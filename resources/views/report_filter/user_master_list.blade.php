<hr>
<div class="row">
    <p class="card-title">Report Filter</p>
    <form action="{{ route('generate') }}" id="report-form" method="post">
        @csrf
        <input type="hidden" name="report_code" value="{{ $report_code }}">

        <button class="btn btn-primary" type="submit">GENERATE <i class="menu-icon mdi mdi-file-document"></i></button>
    </form>
</div>


<script>
    $(document).ready(function(e) {

        $('#report-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            var formData = new FormData(this); // Use this to create FormData from the form directly


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
                    
                }
            });
        });

    })
</script>