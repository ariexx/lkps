<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButton extends Component
{
    public function __construct(public string $route)
    {
    }

    public function render(): View
    {
        return view('components.create-button', [
            'route' => $this->route
        ]);
    }
}
