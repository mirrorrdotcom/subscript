<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageContainer extends Component
{
    public ?string $class;
    public ?bool $centered;

    public function __construct(string $class = "", bool $centered = false)
    {
        $this->class = $class;
        $this->centered = $centered;
    }

    public function render()
    {
        return view('components.page-container');
    }
}
