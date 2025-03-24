<div class="row row-cols-1 row-cols-md-3 g-4">
    <style>
        .card:hover {
            scale: 1.02;
            cursor: pointer;
            transition: all .6s;
            background-color: gainsboro;

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
    <div class="col-sm-12 col-lg-3 col-md-3 mb-4">
        <div class="card h-100 p-3 shadow-sm border-0 hover-card" wire:click="redirect_view('{{ encrypt($module->id) }}')">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2 text-primary font-weight-bold">{{ ucwords($module->title) }}</h5>
                <p class="card-text text-muted text-truncate" style="max-height: 50px;">{{ ucfirst($module->overview) }}</p>

                <!-- Badge Section with Conditional Rendering -->
                <div class="ul mb-3">
                    @if($module->v_flag)
                    <div class="li">
                        <span class="badge badge-info p-1 mx-1">Visual</span>
                    </div>
                    @endif
                    @if($module->k_flag)
                    <div class="li">
                        <span class="badge badge-success p-1 mx-1">Kinesthetic</span>
                    </div>
                    @endif
                    @if($module->a_flag)
                    <div class="li">
                        <span class="badge badge-warning p-1 mx-1">Auditory</span>
                    </div>
                    @endif
                    @if($module->r_flag)
                    <div class="li">
                        <span class="badge badge-danger p-1 mx-1">Reading and Writing</span>
                    </div>
                    @endif
                </div>

                <!-- Author Information -->
                <div class="mt-auto font-12 text-muted font-italic text-truncate" style="max-height: 30px;">
                    Author: {{ base64_decode($module->author->first_name) }}
                    {{ base64_decode($module->author->middle_name) }}
                    {{ base64_decode($module->author->last_name) }}
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center col-12">No learning materials available at the moment.</p>
    @endforelse


</div>

