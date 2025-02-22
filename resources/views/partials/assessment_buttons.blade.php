@if($has_questions AND $type == 'MC')
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

@if($has_questions AND $type == 'I')
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

@if($has_questions AND $type == 'E')
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

@if($has_questions AND $type == 'HO')
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