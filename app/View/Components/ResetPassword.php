<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResetPassword extends Component
{
    /**
     * Create a new component instance.
     */
    public ?string $token;
    public ?string $email;

    public function __construct(?string $token = null, ?string $email = null)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reset-password');
    }
}
