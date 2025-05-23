<?php

namespace App\View\Components;

use App\Models\Message;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Nav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $unread_msg = Message::where([
            'receiver_id'   => Auth::user()->id,
            'seen_flag'     => 0
        ])->count();
        
        return view('components.nav', compact('unread_msg'));
    }
}
