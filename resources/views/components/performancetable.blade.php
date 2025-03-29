<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="card-title">
                        Performance per Modality
                    </div>
                    <table class="table table-bordered table-striped" id="table_performance">
                        <thead class="">
                            <tr>
                                <th>Name</th>
                                <th width="15%">Visual</th>
                                <th width="15%">Auditory</th>
                                <th width="15%">Kinesthetic</th>
                                <th width="15%">Reading & Writing</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via AJAX -->
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function() {
                            $('#table_performance').DataTable({

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
                                ajax: "{{ route('student_performance_table') }}", // Set the route to your getData method
                                columns: [{
                                        data: 'name'
                                    },
                                    {
                                        data: 'visual'
                                    },
                                    {
                                        data: 'auditory'
                                    },
                                    {
                                        data: 'kinesthetic'
                                    },
                                    {
                                        data: 'reading_writing'
                                    },
                                ]
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>