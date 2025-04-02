<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tablesubmissionlesson extends Component
{
    /**
     * Create a new component instance.
     */

    public $module_id;
    public $lesson_id;


    public function __construct($id, $lesson = null)
    {
        //
        $this->module_id = $id;
        $this->lesson_id = $lesson;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $module_id = $this->module_id;
        $lesson_id = $this->lesson_id;
        return view('components.tablesubmissionlesson', compact('module_id','lesson_id'));
    }
}
