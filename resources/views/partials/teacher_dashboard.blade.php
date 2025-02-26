<div class="col-sm-12">
    <div class="home-tab">

        <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h4><b>Avg. Score per Modules</b></h4>

                                        <canvas id="avg_score_per_modules" style="max-height: 400px;" ></canvas>

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
        </div>
    </div>
</div>