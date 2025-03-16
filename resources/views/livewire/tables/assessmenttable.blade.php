<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                @if(sizeof($assessments) > 0)
                <div>
                    <h4 class="card-title">Assessments Feedbacks</h4>
                    <div class="form-group mx- 2">
                        <label for="exampleFormControlSelect3">Show No. of Item</label>
                        <select class="form-select form-select-sm" wire:model.live="per_page" id="exampleFormControlSelect3">
                            <option>10</option>
                            <option>50</option>
                            <option>100</option>
                            <option>ALL</option>
                        </select>
                    </div>
                </div>
                @endif
                <form class="forms-sample material-form">
                    <div class="form-group">
                        <input type="text" required="required" wire:model.live="search_field" class="" autocomplete="off">
                        <label for="input" class="control-label">Search</label><i class="bar"></i>
                    </div>
                </form>
            </div>
            </p>
            <div class="table-responsive">
                <table class="table table-striped  table-bordered">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Date Submitted </th>
                            <th> Type </th>
                            <th> Status </th>
                            <th> Grade </th>
                            <th> Action </th>

                        </tr>
                    </thead>
                    <tbody>

                        @forelse($assessments as $item)
                        <tr>
                            <td class="py-1">
                                <div class="d-flex align-items-center">
                                    <img src="../../assets/images/faces/face1.jpg" alt="image" class="img-fluid rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">

                                    <span class="mx-2"><b>{{ $item->first_name }} {{ $item->last_name }}</b></span>
                                </div>

                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td class="T">
                                @if($item->type == 'Multiple Choice')
                                <span class="badge badge-primary">Multiple Choice</span>

                                @elseif($item->type == 'Identification')
                                <span class="badge badge-warning">Identification</span>

                                @elseif($item->type == 'Essay')
                                <span class="badge badge-success">Essay</span>

                                @else
                                <span class="badge badge-dark">Hands On</span>

                                @endif

                            </td>
                            <td>
                                @if($item->checked_flag == 'Finished')
                                <span class="badge badge-success">Finished</span>
                                @else
                                <span class="badge badge-danger">Pending</span>

                                @endif
                            </td>
                            <td> {{ $item->checked_flag == 'N' ? 'Not Available' : $item->grade }} </td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="navigate('{{ $item->id }}')">View</button>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No Data</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                <br>
                {{ $assessments->links() }}

            </div>
        </div>
    </div>

</div>