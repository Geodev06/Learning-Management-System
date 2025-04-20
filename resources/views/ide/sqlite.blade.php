<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System IDE</title>
    <style>
        *{
            font-family:'Courier New', Courier, monospace;
        }
    </style>
</head>

<body>
    <div class="card mt-2 mb-2" wire:ignore>
        <h3><b>SQLite Compiler</b></h3>
        <div data-pym-src="https://www.jdoodle.com/embed/v1/c739001a1392bc9c"></div>
        <script src="https://www.jdoodle.com/assets/jdoodle-pym.min.js" type="text/javascript"> </script>

        <script>
            // Function to copy text from the <pre> tag
            function copyTextToClipboard() {
                // Get the text from the <pre> tag
                const text = document.getElementById('textToCopy').innerText;

                // Create a temporary textarea element
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);

                // Select the text in the textarea
                textarea.select();
                textarea.setSelectionRange(0, 99999); // For mobile devices

                // Execute the copy command
                document.execCommand('copy');

                // Remove the textarea from the DOM
                document.body.removeChild(textarea);

                // Optional: Alert the user
                Swal.fire({
                    title: 'Success',
                    text: 'Text copied!',
                    icon: 'success'
                })
            }

            // Attach the function to the button's click event
            document.getElementById('copyButton').addEventListener('click', copyTextToClipboard);
        </script>
    </div>
</body>

</html>