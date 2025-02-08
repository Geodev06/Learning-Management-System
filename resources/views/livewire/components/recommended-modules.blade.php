<div class="row row-cols-1 row-cols-md-3 g-4">
    <style>
        .card-mini:hover {
            scale: 1.1;
            cursor: pointer;
            transition: all .3s;
        }

        .text-ellipsis {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Number of lines you want to show before the ellipsis */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 60px;
            /* Adjust this value to match the line height * number of lines */
        }
    </style>
    @forelse($learning_materials as $module)


    <div class="col">
        <div class="card card-mini  shadow-sm mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://img.freepik.com/premium-photo/educational-concept-books-blue_387680-275.jpg" class="img-fluid h-100 rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($module->title) }}</h5>
                        <div class="d-flex">
                            @if($module->v_flag)
                            <span class="badge badge-success p-1 mx-1">Visual</span>
                            @endif
                            @if($module->k_flag)
                            <span class="badge badge-info p-1 mx-1">Kinesthetic</span>
                            @endif
                            @if($module->a_flag)
                            <span class="badge badge-danger p-1 mx-1">Auditory</span>
                            @endif
                            @if($module->r_flag)
                            <span class="badge badge-dark p-1 mx-1">Reading and Writing</span>
                            @endif
                        </div>
                        <p class="card-text"><small class="text-body-secondary">Last updated {{ $module->updated_at->diffForHumans() }}</small></p>
                        <p class="card-text"><small class="text-body-secondary">Author : {{ $module->author_name }} </small></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty

    @endforelse

</div>