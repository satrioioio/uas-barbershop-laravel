<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OwnerLayout extends Component
{
    /**
     * Judul halaman yang ditampilkan di topbar dan title tag.
     */
    public function __construct(
        public string $title = 'Dashboard'
    ) {}

    /**
     * Tampilkan component view.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.owner');
    }
}
