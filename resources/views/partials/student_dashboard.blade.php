<div class="col-sm-12">
    <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#stats" role="tab" aria-selected="false">Stats</a>
                </li>
            </ul>
        </div>
        <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                <div class="row">
                    <div class="col-sm-12">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body card-dash">
                                        <h2>"Hello <b>{{ ucfirst(base64_decode(Auth::user()->first_name)) }}</b>,</h2>

                                        <p>We're excited to have you here! This is where you can track your progress, access your courses,<br> and stay up to date with upcoming assignments.
                                            Take a moment to explore the dashboard and let us know <br>if you need any assistance along the way. <br>
                                            We're here to support you every step of the way. Let's get started!"</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card bg-dark card-rounded">
                                    <div class="card-body pb-0">
                                        <h4 class="card-title card-title-dash text-white mb-4">Status Summary</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="status-summary-ight-white mb-1">No. of Modules Finished</p>
                                                <h2 class="text-info">357</h2>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="status-summary-chart-wrapper pb-4">
                                                    <canvas id="status-summary" width="331" height="66" style="display: block; box-sizing: border-box; height: 66px; width: 331px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                    <h4>Total Points</h4>
                                                    <h1><b>{{ number_format($total_user_points ?? 0)  }}</b></h1>
                                                </div>
                                                <p class="font-12">Points Accumulated from all activities.</p>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex justify-content-between align-items-center">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->learning_modality != NULL)
                    <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body ">
                                        <h4><strong>Learning Modules with Learning Modalities You May Like</strong></h4>
                                        <livewire:components.recommended_modules />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h4><b>My Activities</b></h4>

                                <livewire:tables.pending-task-table />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content tab-content-basic">

                <div class="tab-pane fade show" id="stats" role="tabpanel" aria-labelledby="stats">
                    <div class="row flex-grow">
                        <div class="col-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <h4 class="card-title card-title-dash">Pre-Assessment Report</h4>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <canvas id="pre_assessment_report"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <h4 class="card-title card-title-dash">Performance per Modalities Report</h4>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <canvas id="activity_stats"></canvas>
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
</div>