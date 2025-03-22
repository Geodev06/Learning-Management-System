<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    @include('core.core_css')

    @livewireStyles
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <x-nav />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- partial:partials/_sidebar.html -->
            <x-sidenav />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <h4 class="mb-3">Notifications</h4>
                        <div class="table-responsive">
                            <table class="table table-hover  table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>

                                        <th>Title</th>

                                        <th width="20%">Content</th>
                                        <th width="8%">Date</th>
                                        <th width="20%">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($notifications as $item)

                                    <tr>
                                        <td class="text-primary">
                                            <i class="{{ $item->icon }}"></i>
                                            {{ strtoupper($item->type) }}
                                        </td>
                                        <td>
                                            {{ $item->title }}
                                        </td>

                                        <td>
                                            {{ $item->message }}

                                        </td>

                                        <td>
                                            {{ $item->created_at->format('F d, Y') }}

                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm ">
                                                View
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">
                                                Delete
                                            </button>

                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td colspan="5">No Notifications</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>

                            {{ $notifications->links() }}
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


@livewireScripts

@scripts
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

<script>
    $(document).ready(function(e) {

        $('.table tr').on('click', '.delete-btn', function(e) {
            $.post('/delete-notification', {
                _token: "{{ csrf_token() }}",
                id: $(this)[0].dataset.id
            }, (res) => {
                if (res) {
                    Swal.fire({
                        title: 'Success',
                        text: res,
                        icon: 'success'
                    }).then(() => {
                        window.location.reload()
                    });
                }
            })
        })
    })
</script>

</html>