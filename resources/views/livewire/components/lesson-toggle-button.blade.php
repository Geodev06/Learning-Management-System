<button type="button" wire:click="toggle" class="btn btn-sm btn-{{ $open_flag == 'Y' ? 'success' : 'light' }} btn-rounded btn-fw"> {{ $open_flag == 'Y' ? 'Opened' : 'Closed' }}</button>
