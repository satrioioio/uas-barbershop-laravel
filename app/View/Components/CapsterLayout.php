<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CapsterLayout extends Component
{
    public function __construct(
        public string $title = 'Input Transaksi'
    ) {}

    public function render(): View|Closure|string
    {
        return view('layouts.capster');
    }
}
