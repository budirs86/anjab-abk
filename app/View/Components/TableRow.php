<?php

namespace App\View\Components;

use App\Models\JabatanDiajukan;
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
        public JabatanDiajukan $jabatan,
        public string $type
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
