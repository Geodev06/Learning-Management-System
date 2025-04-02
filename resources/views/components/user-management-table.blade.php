<div class="row">

    <x-modal id="modal_user" title="Edit User">

        <form class="forms-sample material-form" id="user_form">

            @csrf

            <p>Active Status</p>
            <div class="d-flex">
                <input type="hidden" name="id" id="user_id">
                <input type="radio" id="radio-active" value="Y" name="active_flag" aria-label="Active" data-labelauty="Active" />
                <input type="radio" id="radio-inactive" value="N" name="active_flag" aria-label="Inactive" data-labelauty="Inactive" />
            </div>

            <div class="form-group">
                <input type="password" name="password" class="text-primary" autocomplete="off">
                <label for="input" class="control-label">New Password</label><i class="bar"></i>
                <span class="text-danger font-12 error-password"></span>
            </div>


            <div class="button-container">
                <button type="submit"
                    class="btn btn-rounded btn-primary">
                    Save
                </button>
            </div>

        </form>
    </x-modal>
    <script>
        function show_modal(id) {

            $('#modal_user').modal('show')

            loading()
            $.get('/get_specific_user', {
                id: id
            }, function(res) {

                if (res) {

                    $('#user_id').val(res.id)

                    if (res.active_flag == 'Y') {
                        $('#radio-active').prop('checked', true);
                    } else {
                        $('#radio-inactive').prop('checked', true);
                    }

                }
            })
            stop_loading()

        }

        $('#user_form').on('submit', function(e) {
            e.preventDefault();

            var activeFlagValue = $('input[name="active_flag"]:checked').val();
            $('.error-password').text('')
            var formData = $(this).serialize();
            formData += '&active_flag=' + encodeURIComponent(activeFlagValue);
            $.ajax({
                url: '/update-user', // Replace with your URL
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            title: 'Success',
                            text: response,
                            icon: 'success'
                        });
                        $('#user_form')[0].reset()
                        $('#modal_user').modal('hide')
                        $('#tbl_users').DataTable().ajax.reload(null, false);
                    }
                },
                error: function(error) {
                    if(error)
                    {
                        $('.error-password').text(error.responseJSON.errors.password[0])
                    }
                    $('#tbl_users').DataTable().ajax.reload(null, false);
                }
            });
        });
    </script>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="card-title">
                        Users
                    </div>
                    <table class="table table-bordered table-striped" id="tbl_users">
                        <thead class="">
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
                                <th>Last Active</th>
                                <th width="15%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via AJAX -->
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function() {



                            $('#tbl_users').DataTable({
                                responsive: true,
                                buttons: [{
                                        extend: 'copy',
                                        className: 'dt-button buttons-copy'
                                    },
                                    {
                                        extend: 'excel',
                                        className: 'dt-button buttons-excel'
                                    },
                                    {
                                        extend: 'pdf',
                                        className: 'dt-button buttons-pdf'
                                    }
                                ],
                                layout: {
                                    topStart: 'buttons'
                                },
                                processing: true,
                                serverSide: true,
                                ajax: "{{ route('users_table') }}", // Set the route to your getData method
                                columns: [{
                                        data: 'first_name'
                                    },
                                    {
                                        data: 'middle_name'
                                    },
                                    {
                                        data: 'last_name'
                                    },
                                    {
                                        data: 'status'
                                    },
                                    {
                                        data: 'last_login'
                                    },
                                    {
                                        data: 'action'
                                    }
                                ],
                                lengthMenu: [
                                    [10, 25, 50, -1],
                                    [10, 25, 50, "All"]
                                ], // Dropdown for number of records
                                pageLength: 10, // Default number of records
                                dom: 'Blfrtip', // 'l' is the length menu, 'B' is for the buttons
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
</div>