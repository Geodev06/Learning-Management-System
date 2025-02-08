<div class="row row-cols-1 row-cols-md-3 g-4">
    <style>
        .card:hover {
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
        <div class="card h-100">
            <img src="https://img.freepik.com/premium-photo/educational-concept-books-blue_387680-275.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ ucwords($module->title) }} </h5>
              
                <p class="card-text text-ellipsis">{{ ucfirst($module->overview) }}</p>
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
            </div>
        </div>
    </div>
    @empty

    @endforelse

</div>