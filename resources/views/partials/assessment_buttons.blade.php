@php
$validTypes = ['MC', 'I', 'E', 'HO'];
@endphp

@if(in_array($type, $validTypes) && ${'has_questions_' . strtolower($type)})
<div class="button-container">
    <button type="button"
        class="btn btn-rounded btn-primary float-end"
        wire:click="submit()"
        wire:loading.attr="disabled">
        <span wire:loading.remove>Submit Answer</span>
        <span wire:loading>
            <i class="fa fa-spinner fa-spin"></i> Loading...
        </span>
    </button>
</div>
@endif