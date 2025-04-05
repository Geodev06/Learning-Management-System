$(document).ready(function (e) {

    var org_select = $('.org_select').selectize({
        labelField: 'text', // Text to display in the dropdown
        searchField: ['text'], // Which field to search by
        options: [
            {
                text: 'ALL',
                value: 'ALL'
            },
            {
                text: 'BS Computer Science',
                value: 'BS_CS'
            },
            {
                text: 'BS Information Technology',
                value: 'BS_IT'
            }
        ], // Initialize with an empty array of options
        create: false, // Disable the ability to create new options,
    });

    var org_selectControl = org_select[0].selectize;

    $('#report-form').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this);  // Use this to create FormData from the form directly

        var selectedValue = org_selectControl.getValue();

        formData.append('org_code', selectedValue);

        // Call loading function
        loading();

        // Perform the AJAX request
        $.ajax({
            url: 'generate', // Replace with the URL you want to send the request to
            type: 'POST',
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting the content-type (important for FormData)
            success: function (response) {
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

                    const blob = new Blob(byteArrays, { type: 'application/pdf' });

                    const blobUrl = URL.createObjectURL(blob);

                    window.open(blobUrl, '_blank');
                } else {
                    console.error('Error generating PDF');
                }
            },
            error: function (xhr, status, error) {
                stop_loading();
                $.each(xhr.responseJSON.errors, function (field, messages) {
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