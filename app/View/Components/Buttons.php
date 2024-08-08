<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Buttons extends Component
{
    public function __construct(
        public null|string $routeEdit,
        public null|string $routeDelete,
        public null|string $routeApprove = null,
        public null|string $routeReject = null,
        public null|int $isApproved = null
    )
    {
    }
    public function render(): View
    {
        return view('components.buttons', [
            'routeEdit' => $this->routeEdit ?? null,
            'routeDelete' => $this->routeDelete ?? null,
            'routeApprove' => $this->routeApprove ?? null,
            'routeReject' => $this->routeReject ?? null,
            'isApproved' => $this->isApproved
        ]);
    }
}
