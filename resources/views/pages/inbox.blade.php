<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    @include('core.core_css')

    @livewireStyles
    <style>
        .message-section {
            max-height: 600px;
            /* Set max-height to your desired height */
            overflow-y: auto;
            /* Enable scrolling */
        }

        /* Hide the scrollbar */
        .message-section::-webkit-scrollbar {
            display: none;
            /* This will hide the scrollbar */
        }

        
    </style>
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
                        <h4>Inbox</h4>

                        <div class="col-lg-3">
                            <div class="d-flex flex-column user-list">

                                <div>
                                    <form class="forms-sample material-form d-flex align-items-center" action="/inbox">
                                        <div class="form-group w-100 mx-4">
                                            @csrf
                                            <input type="text" name="search" id="search" class=" text-primary" autocomplete="off">
                                            <label for="input" class="control-label">Search</label><i class="bar"></i>
                                        </div>

                                        <div class="button-container mx-2">
                                            <button type="submit" class="btn btn-rounded btn-primary" id="submit">
                                                <span>Search</span>
                                            </button>
                                        </div>

                                    </form>
                                </div>

                                @forelse($users as $user)
                                <div class="card mb-2 user" style="cursor: pointer;" data-id="{{ $user->id }}" data-name="{{ base64_decode($user->first_name) }} {{ base64_decode($user->last_name) }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs rounded-circle" src="{{ $user->profile ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" alt="Profile image">
                                            <div class="mx-2">
                                                <div>
                                                    <p class="m-0"><b>{{ base64_decode($user->first_name) }} {{ base64_decode($user->last_name) }}</b></p>
                                                    <p class="m-0">Online</p>

                                                    @if($user->unseen > 0)
                                                    <div class="d-flex m-0">
                                                    <span class="badge badge-danger font-12">{{ $user->unseen }} </span> <p class="mx-3 m-0">New Message!</p>
                                                    </div>

                                                    @else

                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty

                                <p>Empty Inbox</p>
                                @endforelse

                                <div class="mt-2">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="d-flex flex-column">

                                <div class="card message-container" style="display: none;">
                                    <div class="card-body " >
                                        <h4 class="receiver_name fw-bold"></h4>
                                        <p>Online</p>

                                        <div class="message-section" style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
                                            <!-- automatically scrolldonw -->
                                        </div>


                                    </div>

                                    <div class="bg-white">
                                        <form class="forms-sample material-form d-flex align-items-center" id="message_form" data-receiver_id="">
                                            <div class="form-group w-100 mx-4">
                                                @csrf
                                            <p class="error text-danger font-12"></p>

                                                <input type="text" required="required" name="message" id="message" class=" text-primary" autocomplete="off">
                                                <label for="input" class="control-label">Your message here</label><i class="bar"></i>
                                            </div>

                                            <div class="button-container mx-2">
                                                <button type="submit" class="btn btn-rounded btn-primary" id="send_button" disabled>
                                                    <span>Send</span>
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <p class="click_lbl">Click person to message</p>

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
    $(document).ready(function() {
        // Function to get messages and display them
   

        // Trigger when a user is clicked
        $('.user-list').on('click', '.user', function(e) {
            var receiver_id = $(this)[0].dataset.id;
            var receiver_name = $(this)[0].dataset.name;

            // Set receiver details
            $('#message_form').attr('data-receiver_id', receiver_id);
            $('.receiver_name').text(receiver_name);

            // Fetch and display messages for the clicked user
            get_message(receiver_id);
        });

        // Handle the typing event (enabling the send button)
        $('#message').on('keyup', function(e) {
            if ($(this).val() == '') {
                $('#send_button').attr('disabled', 'disabled');
            } else {
                $('#send_button').removeAttr('disabled');
            }
        });

        // Handle the message form submission (sending a new message)
        $('#message_form').on('submit', function(e) {
            e.preventDefault();

            var message = $('#message').val();

            // Display loading indicator
            loading();
            $('.error').text('')
            // Send the message via AJAX
            $.ajax({
                url: '/send-message',
                type: 'POST',
                data: {
                    message: message,
                    receiver_id: $(this)[0].dataset.receiver_id,
                    _token: '{{ csrf_token() }}' // CSRF token for security
                },
                success: function(response) {
                    // Stop loading indicator
                    stop_loading();

                    // Clear the message input
                    $('#message').val('');

                    // Reload the messages and scroll to the bottom
                    get_message($('#message_form')[0].dataset.receiver_id);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    stop_loading();
                    $('.error').text(xhr.responseJSON.message)
                }
            });
        });
    });
</script>
@include('partials.pusher_notification')

@livewireScripts

</html>