<div class="row">
    <style>
        .file-text {
            white-space: nowrap;
            /* Ensure the text stays on a single line */
            overflow: hidden;
            /* Hide the text that overflows */
            text-overflow: ellipsis;
            /* Add ellipsis when the text overflows */
            max-width: 100%;
            /* Limit width to parent element */
            display: block;
            /* Make sure it's a block element for proper text handling */
        }
    </style>
    <div class="col-lg-12">
        <div class="row">
            @forelse($files as $file)
            <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                <div class="card cursor-pointer"
                    wire:click="$dispatch('render-file', { payload: '{{ $file->file_path }}', type: '{{ $file->file_type }}' })">
                    <div class="card-body">
                        @if($file->file_type == 'PDF')
                        <i class="fa fa-file-pdf-o text-danger"></i>
                        <p class="file-text">{{ $file->orig_file_name ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'PPT')
                        <i class="fa fa-file-powerpoint-o text-danger"></i>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'LINK')
                        <i class="fa fa-external-link text-danger"></i>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'OTHER')
                        <i class="fa fa-file-zip-o text-danger"></i>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif
                    </div>

                </div>
            </div>
            @empty

            @endforelse
        </div>
    </div>
   
</div>