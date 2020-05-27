<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageContainer extends Component
{
    public ?string $class;

    public function __construct(string $class = "")
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('components.page-container');
    }
}
