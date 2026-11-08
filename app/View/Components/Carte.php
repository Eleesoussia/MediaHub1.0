<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;

class Carte extends Component
{
    public function __construct(
        public string $titre,
        public ?string $meta = null,
    ) {}

    public function render(): \Illuminate\Contracts\View\View|Closure|string
    {
        return view('components.carte');
    }
}