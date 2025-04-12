<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="card-title">
                        Task
                    </div>
                    <div class="col-sm-12 mb-4">
                        <a class="btn  btn-primary float-end mb-2"
                            href="{{ route('assignments_and_projects.form') }}">Add Assigment/Project</a>
                    </div>
                    <table class="table table-bordered table-striped" id="task_table">
                        <thead class="">
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>No. of participants</th>
                                <th>Modality</th>
                                <th>Date Posted</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via AJAX -->
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function() {


                            const $table_route = `{{ route('task_table') }}`;


                            $('#task_table').DataTable({
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
                                ajax: $table_route, // Set the route to your getData method
                                columns: [{
                                        data: 'title'
                                    },
                                    {
                                        data: 'type'
                                    },
                                    {
                                        data: 'no_of_participants'
                                    },
                                    {
                                        data: 'modality'
                                    },
                                    {
                                        data: 'posted_date',
                                        
                                    },
                                    {
                                        data: 'deadline'
                                    },
                                    {
                                        data: 'status'
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