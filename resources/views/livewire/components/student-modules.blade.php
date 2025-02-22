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
    <div class="col-lg-3">
        <div class="card p-3 h-100 style=" width: 18rem;">
            <img style="max-height: 100px;" src="https://www.reliservsolution.net/wp-content/uploads/2021/10/Substation-Automation-4.jpg" class="card-img-top" alt="...">

            <div class="card-body">
                <p><b>{{ ucfirst($module->title) }}</b></p>
                <p class="card-text text-ellipsis">{{ ucfirst($module->overview) }}</p>

            </div>
            <button class="btn btn-primary" wire:click="redirect_learn('{{ encrypt($module->id) }}')">Learn</button>
        </div>
    </div>
    @empty
    <div class="col-lg-12 mt-4">
        <p>You Don't have any course taken.</p>
    </div>
    @endforelse

</div>