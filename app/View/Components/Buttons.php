<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Buttons extends Component
{
    public function __construct(
        public null|string $routeEdit,
        public null|string $routeDelete,
    )
    {
    }
    public function render(): View
    {
        return view('components.buttons', [
            'routeEdit' => $this->routeEdit ?? null,
            'routeDelete' => $this->routeDelete ?? null,
        ]);
    }
}
