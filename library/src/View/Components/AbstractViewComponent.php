<?php

namespace Larabase\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AbstractViewComponent extends Component
{
    public string $type;

    public ?string $dismissible;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type, string $dismissible = null)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
