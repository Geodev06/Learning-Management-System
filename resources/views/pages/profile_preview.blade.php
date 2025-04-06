<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>
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


                        <div class="col-lg-12 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-9 col-md-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <img
                                                    class="mx-2"
                                                    style="max-height: 150px; max-width: 150px; width: 150px; height: 150px; border-radius: 100%"
                                                    src="{{ $user->profile == null ? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' : asset($user->profile) }}" alt="x">
                                                <div class="mx-2 mb-3">
                                                    <h2><b>{{ ucfirst(base64_decode($user->first_name)) }} {{ ucfirst(base64_decode($user->last_name)) }} , {{ ucfirst(base64_decode($user->middle_name)) }}</b></h2>
                                                    <p class="m-0">BS information technology</p>
                                                    <p class="m-0">Gender :
                                                        @if($user->gender == 'M')
                                                        Male
                                                        @endif

                                                        @if($user->gender == 'F')
                                                        Female
                                                        @endif

                                                        @if($user->gender == 'NS')
                                                        Not Specified
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 align-items-center d-grid">
                                            <div class="d-flex">
                                                @if(Auth::user()->role == 'ADMIN' OR Auth::user()->role == 'TEACHER')
                                                <button class="btn btn-warning mx-2 btn-add-award">Commend <i class="mx-2 fa fa-star"></i></button>
                                                <a href="/inbox/{{ encrypt($user->id) }}" class="btn btn-primary">Message <i class="mx-2 fa fa-envelope"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body card-rounded">
                                    <h4 class="card-title  card-title-dash">Recent Awards & Recognitions</h4>
                                    <div class="list align-items-center border-bottom py-2">


                                        @forelse($awards as $award)
                                        <div class="wrapper w-100 mb-2">
                                            <p class="mb-0 fw-light fs-6">{!!  $award->icon !!} {{ $award->title }} </p>
                                            <p class="m-0" style="font-style: italic;"> - {{ $award->description }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-calendar text-muted me-1"></i>
                                                    <p class="mb-0 text-small text-muted">{{ $award->date }}</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-star text-muted me-1"></i>
                                                    <p class="mb-0 text-small text-warning">Given by : {{ $award->given_by }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="mb-0 fw-light fs-6">No Awards</p>

                                        @endforelse



                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <div class="home-tab card p-4 ">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="overview" aria-selected="true">Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#modules" role="tab" aria-selected="false">Modules</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details">

                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="card card-rounded">
                                                    <div class="card-body p-5">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                                            <h4 class="card-title card-title-dash">Details</h4>
                                                        </div>
                                                        <hr>

                                                        <div class="d-flex ">
                                                            <p> <b>First Name</b> : </p>
                                                            <p class="text-muted">{{ ucfirst(base64_decode($user->first_name)) }} </p>
                                                        </div>

                                                        <div class="d-flex ">
                                                            <p> <b>Middle Name</b> : </p>
                                                            <p class="text-muted">{{ ucfirst(base64_decode($user->middle_name)) }} </p>
                                                        </div>

                                                        <div class="d-flex ">
                                                            <p> <b>Last Name</b> : </p>
                                                            <p class="text-muted">{{ ucfirst(base64_decode($user->last_name)) }} </p>
                                                        </div>

                                                        <div class="d-flex ">
                                                            <p> <b>Institutional Email</b> : </p>
                                                            <p class="text-muted">{{ ucfirst($user->email) }} </p>
                                                        </div>

                                                        <div class="d-flex align-items-center">

                                                            @if($user->active_flag == 'Y')
                                                            <span class="badge badge-success">Active</span>
                                                            @else
                                                            <span class="badge badge-danger">Active</span>
                                                            @endif
                                                        </div>

                                                        <div class="d-flex">
                                                            <p>Last Login : {{ $user->updated_at }}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-content tab-content-basic">

                                        <div class="tab-pane fade show" id="modules" role="tabpanel" aria-labelledby="modules">
                                            <div class="row ">

                                                <div class="col-md-12">
                                                    <div class="card card-rounded p-5">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <h4 class="card-title card-title-dash">Modules</h4>
                                                                <!-- <p class="mb-0">20 finished, 5 remaining</p> -->
                                                            </div>
                                                            <ul class="bullet-line-list">
                                                                @forelse($user_modules as $item)
                                                                <li>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div>
                                                                            <span class="text-light-green h5"><b>{{ $item->modules->title ?? '' }}</b></span>
                                                                            <br>
                                                                            @if($item->modules->k_flag == 1)
                                                                            <span class="badge badge-danger">Kinesthetic</span>
                                                                            @endif

                                                                            @if($item->modules->v_flag == 1)
                                                                            <span class="badge badge-success">Visual</span>
                                                                            @endif

                                                                            @if($item->modules->a_flag == 1)
                                                                            <span class="badge badge-primary">Auditory</span>
                                                                            @endif

                                                                            @if($item->modules->r_flag == 1)
                                                                            <span class="badge badge-dark">Reading and Writing</span>
                                                                            @endif
                                                                        </div>
                                                                        <p>Joined : {{ $item->created_at->format('F d, Y') }}</p>
                                                                    </div>
                                                                </li>
                                                                @empty
                                                                <li>No Data</li>
                                                                @endforelse

                                                            </ul>
                                                            {{ $user_modules->links() }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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

    <x-modal id="modal_award" title="Commend">
        <form id="#form_award">
            @csrf
            <span id="award-error" class="font-12 text-danger error"></span>

            <div class="form-group w-100">
                <label>Award List</label>

                <select class="select_award" style="width: 100%" name="award">
                    <option value="" selected>Choose one</option>
                </select>

            </div>

            <div class="form-group w-100">
                <label for="date">Date Acquired</label>
                <input id="date" class="form-control" type="date" name="date_acquired" />

            </div>
            <button class="btn btn-danger" id="btn-save-award" type="button">Commend <i class="menu-icon mdi mdi-star"></i></button>
        </form>
    </x-modal>
</body>
@include('core.core_js')

<script>
    $(document).ready(function(e) {

        var award_select = $('.select_award').selectize({
            valueField: 'value', // Value field for the options
            labelField: 'text', // Text to display in the dropdown
            searchField: ['text'], // Which field to search by
            options: [],
        });
        var award_select_control = award_select[0].selectize;

        $.get("{{ route('get_award_list') }}", {}, function(res) {
            award_select_control.addOption(res); // Adding options to the Selectize dropdown
            award_select_control.refreshOptions(); // Refresh to update the dropdown
        })

        $('.btn-add-award').on('click', function(e) {
            $('#modal_award').modal('show')
        })

        $('#btn-save-award').on('click', function(e) {
            e.preventDefault(); // Prevent form submission

            // Clear any previous error messages
            $('.error').text('');

            // Create FormData object from the form
            var formData = new FormData($('#form_award')[0]);
            var selectedValue = award_select_control.getValue();

            formData.append('award', selectedValue);
            formData.append('date_acquired', $('#date').val());
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('user_id', "{{ $user->id }}");

            loading();

            $.ajax({
                url: "{{ route('commend') }}", // Replace with the URL you want to send the request to
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content-type (important for FormData)
                success: function(response) {
                    // Stop the loading indicator on successful submission
                    stop_loading();
                    if (response) {
                        window.location.reload()
                    }
                },
                error: function(xhr, status, error) {
                    // Stop the loading indicator in case of error
                    stop_loading();
                    $('.error').text(xhr.responseJSON)
                }
            });
        });

    })
</script>
@livewireScripts



</html>