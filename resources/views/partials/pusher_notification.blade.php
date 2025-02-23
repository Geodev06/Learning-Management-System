<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('01959106db1486ee27c9', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('notifications');


    function render_notifications() {

        $.get('/notifications', {}, function(res) {

            $('#notification-container').html('')
            $('#notification-container').removeClass('show')

            $('#notification-container').html(res)
        })
    }

    render_notifications()
    
    channel.bind('notify-users', function(data) {

        console.log(data)
        render_notifications()
    });
</script>