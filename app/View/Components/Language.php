<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Language extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $params['kz'] = request()->route()->parameters;
        $params['ru'] = request()->route()->parameters;

        $params['ru']['language'] = 'ru';
        $params['kz']['language'] = 'kz';

        return view('components.language-component', compact('params'));
    }
}
