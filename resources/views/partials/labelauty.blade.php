
<link rel="stylesheet" href="{{ asset('assets/labelauty/jquery-labelauty.css') }}">
<script src="{{ asset('assets/labelauty/jquery-labelauty.js') }}"></script>

<script>
    $(document).ready(function(e) {
        $(":checkbox").labelauty();
        $(":radio").labelauty();
    })
</script>