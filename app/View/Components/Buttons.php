<?php

// app/View/Components/Buttons.php
namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Buttons extends Component
{
    public function __construct(
        public null|string $routeEdit,
        public null|string $routeDelete,
        public null|string $routeApprove = null,
        public null|string $routeReject = null,
        public null|int $isApproved = null,
    )
    {
    }

    public function render(): View
    {
        return view('components.buttons', [
            'routeEdit' => $this->routeEdit,
            'routeDelete' => $this->routeDelete,
            'routeApprove' => $this->routeApprove,
            'routeReject' => $this->routeReject,
            'isApproved' => $this->isApproved,
        ]);
    }
}
