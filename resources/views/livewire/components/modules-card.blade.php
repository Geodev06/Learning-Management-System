<div class="row">
    @forelse($modules as $module)
    <div class="col-sm-12 col-md-6 col-lg-3 mb-2">

        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h4>{{ ucfirst($module->title) }}</h4>
                    <div class="d-flex justify-content-between">
                        @if($module->post_flag == 'Y')
                        <i class="fa fa-folder text-primary cursor-pointer"
                        wire:click="$dispatch('manage', { id: '{{ base64_encode($module->id) }}' })"
                         data-bs-toggle="tooltip" title="Manage"></i>
                        @else
                        <i class="fa fa-pencil text-primary mx-2 cursor-pointer"
                         wire:click="$dispatch('show-modal', { id: {{ $module->id }}, action : 'Edit' })"
                         data-bs-toggle="tooltip" title="Edit"></i>
                        <i class="fa fa-trash-o text-danger cursor-pointer"
                         wire:click="$dispatch('show-delete-modal', { id: {{ $module->id }} })"
                         data-bs-toggle="tooltip" title="Delete"></i>
                        @endif
                    </div>
                </div>
                <p class="font-12">{{ $module->overview }}</p>

                <div class="row mt-auto">
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
    </div>
    @empty
    <div class="col-lg-12">
        <p>No Data</p>
    </div>
    @endforelse

    {{ $modules->links() }}


    @script
    <script>
        $wire.on('show-modal', (data)=> {
            $('#modal').modal('show')
        })
        $wire.on('show-delete-modal', (data)=> {
            $('#delete_modal').modal('show')
        })
    </script>

    @endscript

</div>