<?php

namespace App\View\Components;

use App\Models\Menu;
use Illuminate\View\Component;

class sidebarComponent extends Component
{
    public $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu = [])
    {
        $this->items = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(count($this->items) === 0)
            $menu = Menu::where('level', 0)->get();
        else
            $menu = $this->items;
        return view('components.sidebar-component', compact('menu'));
    }
}
