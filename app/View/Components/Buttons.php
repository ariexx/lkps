<?php

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
        public string $role = 'dosen'
    )
    {
    }
    public function render(): View
    {
        if (isset(Auth::user()->role)) {
            $this->role = Auth::user()->role;
        } else {
            $this->role = user()->role;
        }
        return view('components.buttons', [
            'routeEdit' => $this->routeEdit ?? null,
            'routeDelete' => $this->routeDelete ?? null,
            'routeApprove' => $this->routeApprove ?? null,
            'routeReject' => $this->routeReject ?? null,
            'isApproved' => $this->isApproved,
            'role' => $this->role,
        ]);
    }
}
