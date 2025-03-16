<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('01959106db1486ee27c9', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('user_notifications');


    function render_notifications() {

        $.get('/notifications', {}, function(res) {

            $('#notification-container').html('')
            $('#notification-container').removeClass('show')

            $('#notification-container').html(res)
        })
    }

    render_notifications()


    function get_message(receiver_id) {
        $.get('/get-message', {
            receiver_id: receiver_id
        }, function(res) {
            $('.message-container').show();
            $('.message-section').html(res);

            $('.click_lbl').hide();


            // Ensure the messages are scrolled to the bottom after loading
            scrollToBottom();
        });
    }


    // Scroll to the bottom of the message section
    function scrollToBottom() {
        var messageSection = document.querySelector('.message-section');
        messageSection.scrollTop = messageSection.scrollHeight;
    }

    channel.bind('notify-users', function(data) {

        if (data.message == 'notify-users') {
            render_notifications()
        }

        if (data.message == 'get_message') {

            if ($('#message_form')[0].dataset.receiver_id) {

                get_message($('#message_form')[0].dataset.receiver_id);

            }
        }
    });
</script>