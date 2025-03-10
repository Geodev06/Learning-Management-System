<div class="col-lg-12 mb-2">
    <div class="card">
        <div class="card-body">
            <h4>{{ ucfirst($module->title) }}</h4>
            <p>{{ ucfirst($module->overview) }}</p>
            <p class="text-primary"> <b>Overall Progress {{ number_format($progress, 2) }}%</b></p>
        </div>
    </div>
</div>