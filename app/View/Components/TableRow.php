<?php

namespace App\View\Components;

use App\Models\Jabatan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Boolean;

class TableRow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Jabatan $jabatan,
        public bool $editable = false,
        public bool $abk = false
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-row');
    }
}
