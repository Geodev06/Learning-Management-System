<div class="col-sm-12">
    <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#learners" role="tab" aria-selected="false">Learners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                </li>
            </ul>

        </div>
        <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8 mb-2">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Learning Modules</p>
                                        <h3 class="rate-percentage">{{ number_format($data['no_of_modules'], 0) }}</h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Available Activities</p>
                                        <h3 class="rate-percentage">{{ number_format($data['no_of_activities'], 0) }}</h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Accounts</p>
                                        <h3 class="rate-percentage">{{ number_format($data['no_of_users'], 0) }}</h3>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Student Submission Today</p>
                                        <h3 class="rate-percentage">{{ number_format($data['no_of_student_submission_today'], 0) }}</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h4><b>Pending Task</b></h4>

                                        <livewire:tables.pending-task-table />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <livewire:components.leaderboard />
                            </div>
                        </div>
                    </div>



                </div>


            </div>

            <div class="tab-pane fade show " id="learners" role="tabpanel" aria-labelledby="learners">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                        <livewire:components.learnerlist lazy="on-load" />
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>