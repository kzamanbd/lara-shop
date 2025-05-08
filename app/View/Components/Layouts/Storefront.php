<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Storefront extends Component
{

    /**
     * Create a new component instance.
     *
     * @param string $title
     */
    public function __construct(public string $title) {}

    /**
     * Get the view or contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.layouts.storefront');
    }
}
