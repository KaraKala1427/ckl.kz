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
    public function __construct($items = null)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (!empty($this->items)) {
            $menu = $this->items;
        } else {
            $menu = Menu::where('level', 0)->with('children')->get();
//            dd("salam",$menu);
        }
        return view('components.sidebar-component', compact('menu'));
    }
}
