<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    @include('core.core_css')

    @livewireStyles


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

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body ">
                                    <h4 class="card-title">Reports</h4>
                                    <div class="form-group w-100">
                                        <label>Report List</label>

                                        <select class="js-example-basic-single" style="width: 100%">
                                            <option value="" selected>Choose one</option>
                                        </select>

                                    </div>

                                    <div class=" report-filter-container">

                                    </div>
                                </div>
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


@livewireScripts


<script>
    $(document).ready(function() {
        // Initialize Selectize
        var report_select = $('.js-example-basic-single').selectize({
            valueField: 'id', // Value field for the options
            labelField: 'text', // Text to display in the dropdown
            searchField: ['text'], // Which field to search by
            options: [], // Initialize with an empty array of options
            onChange: function(value) {

                loading()
                $.get("{{ route('render_filter') }}", {
                    report_code: value
                }, function(res) {
                    $('.report-filter-container').html("")
                    $('.report-filter-container').html(res)

                });

                stop_loading()
            }
        });

        var selectizeControl = report_select[0].selectize;
        // Fetch data from the server
        $.get("{{ route('report_list') }}", {}, function(res) {
            selectizeControl.addOption(res); // Adding options to the Selectize dropdown
            selectizeControl.refreshOptions(); // Refresh to update the dropdown
        });




    });
</script>


</html>