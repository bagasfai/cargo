<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $variant = 'primary',
        public string $size = 'md',
        public bool $disabled = false,
        public bool $loading = false,
        public ?string $href = null,
        public ?string $iconLeft = null,
        public ?string $iconRight = null,
        public string $type = 'button',
    ) {}

    public function isLink(): bool
    {
        return filled($this->href);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.button');
    }
}
