<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontendLayout extends Component
{
    public $title;
    public $settings;
    public $categories;
    public $carts;
    /**
     * Create a new component instance.
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
        $this->settings = Setting::latest()->first() ?? new Setting();
        $this->categories = Category::where('status', 1)->get();
        $this->carts = Cart::where('session_id', session()->getId())->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.layouts.app');
    }
}
