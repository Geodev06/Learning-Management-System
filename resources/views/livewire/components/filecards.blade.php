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

            <div class="col-sm-12">
                <form class="forms-sample material-form float-end">
                    <div class="form-group">
                        <input type="text" required="required" wire:model.live="search" class=" text-primary" autocomplete="off">
                        <label for="input" class="control-label">Search</label><i class="bar"></i>
                    </div>
                </form>
            </div>
            @forelse($files as $file)
            <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                <div class="card h-100 cursor-pointer border">
                    <div class="card-body" wire:click="$dispatch('render-file', { payload: '{{ $file->file_path }}', type: '{{ $file->file_type }}' })">
                        @if($file->file_type == 'PDF')
                        <i class="fa fa-file-pdf-o text-danger"></i>
                        <p class="m-0"><b>{{ $file->orig_file_name ?? ''  }}</b></p>
                        <p class="file-text">{{ $file->orig_file_name ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'PPT')
                        <i class="fa fa-file-powerpoint-o text-danger"></i>
                        <p class="m-0"><b>{{ $file->caption ?? ''  }}</b></p>
                        <p class="file-text">MICROSOFT PRESENTATION</p>

                        @endif

                        @if($file->file_type == 'AUDIO')
                        <i class=" fa fa-music text-danger"></i>
                        <p class="m-0"><b>{{ $file->orig_file_name ?? ''  }}</b></p>
                        <p class="file-text">AUDIO/MP3</p>

                        @endif

                        @if($file->file_type == 'VIDEO')
                        <i class="fa fa-file-video-o text-danger"></i>
                        <p class="m-0"><b>{{ $file->orig_file_name ?? ''  }}</b></p>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'IMAGES')
                        <i class="fa fa-image text-danger"></i>
                        <p class="m-0"><b>{{ $file->orig_file_name ?? ''  }}</b></p>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'LINK')
                        <i class="fa fa-external-link text-danger"></i>
                        <p class="m-0"><b>{{ $file->caption ?? ''  }}</b></p>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif

                        @if($file->file_type == 'OTHER')
                        <i class="fa fa-file-zip-o text-danger"></i>
                        <p class="m-0"><b>{{ $file->orig_file_name ?? ''  }}</b></p>
                        <p class="file-text">{{ $file->file_path ?? '' }}</p>
                        @endif


                    </div>
                    @if(Auth::user()->role == 'ADMIN')
                    <div class="card-body">
                        <button class="btn btn-lg btn-danger text-white" wire:click="$dispatch('delete-file', { id: '{{ $file->id }}', name: '{{ $file->orig_file_name }}' })">DELETE</button>
                    </div>
                    @endif


                </div>
            </div>
            @empty

            @endforelse
        </div>


        <x-modal id="modal_preview" size="modal-lg" title="Preview">
            <div class="content">
            </div>
            <button class="btn btn-md text-white btn-primary" type="button" id="btn-dl">Download File</button>
        </x-modal>

        <x-modal id="delete_file" size="modal-md" title="Delete Material">
            <p>Are you sure you want to delete this learning material</p>
            <p class="item-name"></p>
            <button class="btn btn-lg text-white btn-danger" type="button" id="btn-delete">Delete</button>
        </x-modal>

        @script
        <script>
            $wire.on('render-file', (payload) => {
                $('#btn-dl').hide()

                switch (payload.type) {
                    case 'PDF':
                        $('.content').html(`
                            <embed src="{{ asset('${payload.payload}') }}" width="100%" height="720" type="application/pdf" id="pdf_viewer">
                        `)

                        $('#btn-dl').show()
                        $('#btn-dl').attr('data-link', payload.payload)

                        $('#btn-dl').on('click', function(e) {
                            var x = $(this)[0].dataset.link
                            var url = "{{ asset(':path') }}"
                            window.open(url.replace(':path', x), '_blank')
                        })

                        break;
                    case 'PPT':
                        loading()
                        $('.content').html(payload.payload)

                        stop_loading()

                        break;

                    case 'AUDIO':
                        loading()
                        $('.content').html(`
                        <audio controls >
                            <source src="{{ asset('${payload.payload}') }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        `)
                        stop_loading()
                        break;

                    case 'IMAGES':
                        loading()
                        $('.content').html(`
                            <img src="{{ asset('${payload.payload}') }}" alt="Uploaded Image" width="100%">
                        `)
                        stop_loading()
                        break;

                    case 'VIDEO':
                        $('.content').html(
                            `
                            <video width="100%" height="720" controls>
                                <source src="{{ asset('${payload.payload}') }}" type="video/mp4">
                            Your browser does not support the video tag.
                            </video>
                        `
                        )
                        $('#btn-dl').show()

                        $('#btn-dl').attr('data-link', payload.payload)

                        $('#btn-dl').on('click', function(e) {
                            var x = $(this)[0].dataset.link

                            var url = "{{ asset(':path') }}"
                            window.open(url.replace(':path', x), '_blank')
                        })

                        break;

                    case 'OTHER':
                        $('.content').html('Preview Not available.')
                        $('#btn-dl').show()

                        $('#btn-dl').attr('data-link', payload.payload)

                        $('#btn-dl').on('click', function(e) {
                            var x = $(this)[0].dataset.link

                            var url = "{{ asset(':path') }}"
                            window.open(url.replace(':path', x), '_blank')
                        })
                        break;

                    case 'LINK':

                        window.open(payload.payload, "_blank");
                        $('#modal_preview').modal('hide')
                        $video_id = payload.payload.split("=")[1]
                        $img = '<img src="https://img.youtube.com/vi/:video_id/maxresdefault.jpg" width="100%" alt="YouTube Thumbnail">'
                        $preview_html = $img.replace(':video_id', $video_id)
                        $('.content').html($preview_html)

                        break;
                }



                $('#modal_preview').modal('show')
            })

            $wire.on('delete-file', (payload) => {

                $('.item-name').text('')
                $('.item-name').text(payload.name)
                $('#delete_file').modal('show')
                $('#btn-delete').attr('wire:click', "delete_item(" + payload.id + ")")
            })

            $wire.on('close_modal', (payload) => {

                $('#delete_file').modal('hide')
            })
        </script>
        @endscript
    </div>
</div>