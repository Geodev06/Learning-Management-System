<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="card-title">
                        Submissions
                    </div>
                    <table class="table table-bordered table-striped" id="table_submission_per_lesson">
                        <thead class="">
                            <tr>
                                <th>Name</th>
                                <th>No. of Items</th>
                                <th>Grade</th>
                                <th>Mark</th>
                                <th>Activity Type</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via AJAX -->
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function() {


                            var $table_route = `{{ route('submission_table_per_lesson', ['module_id' => $module_id, 'lesson_id' => $lesson_id]) }}`;

                           

                            $('#table_submission_per_lesson').DataTable({
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
                                columns: [
                                    {
                                        data: 'fullname'
                                    },
                                    {
                                        data: 'no_of_items'
                                    },
                                    {
                                        data: 'grade'
                                    },
                                    {
                                        data: 'mark'
                                    },
                                    {
                                        data: 'type'
                                    },
                                    {
                                        data: 'status'
                                    },
                                    {
                                        data: 'created_at'
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