<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuruAppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $title = "Halaman Utama";
        return view('layouts.guruapp');
    }
}
