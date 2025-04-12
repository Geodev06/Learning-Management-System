<div class="row">
    <style>
        .card:hover {
            scale: 1.02;
            cursor: pointer;
            transition: all .6s;

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

    <h4>My Modules</h4>
    @forelse($modules as $module)
    <div class="col-lg-3 mb-2">
        <div class="card p-3 h-100 shadow-sm" style="background-color: #EDF3FC;">

            <div class="card-body">
                <img src="{{ asset('assets/images/book.png') }}" alt="" srcset="" style="max-width: 50px; max-height:50px">

                <p><b>{{ ucfirst($module->title) }}</b></p>
                <p class="card-text text-ellipsis">{{ ucfirst($module->overview) }}</p>

              

            </div>
            <button type="button" class="btn btn-primary btn-rounded" wire:click="redirect_learn('{{ encrypt($module->id) }}')">Learn <i class="fa fa-arrow-circle-right float-end"></i>
            </button>
        </div>
    </div>
    @empty
    <div class="col-lg-12 mt-4">
        <p>You Don't have any course taken.</p>
    </div>
    @endforelse

</div>