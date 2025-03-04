<div>
    <div id="carouselLearningMaterials" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
            $chunks = $learning_materials->chunk(3); // Chunk the materials into groups of 3
            @endphp

            <!-- Carousel controls -->


            @foreach($chunks as $index => $chunk)
            <div class="carousel-item @if($index == 0) active @endif">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($chunk as $module)
                    <div class="col">
                        <div class="card border card-mini shadow-sm mb-3" style="max-width: 540px; background-color: #EDF3FC;" wire:click="view_module('{{encrypt($module->id)}}')">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <img src="{{ asset('assets/images/book.png') }}" alt="" style="max-width: 50px; max-height:50px">
                                            <div class="mx-auto">
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
                                                <p class="card-text"><small class="text-body-secondary">Author: {{ $module->author_name }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @endforeach

        </div>


    </div>

    <button class="carousel-control-prev " type="button" data-bs-target="#carouselLearningMaterials" data-bs-slide="prev">
        <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselLearningMaterials" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
    <!-- Add some styles for hover effect -->
    <style>
        .card-mini:hover {
            scale: 1.02;
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

</div>