<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormCheckbox extends Component
{
    public string $name;
    public ?string $label;
    public ?string $icon = "";
    public ?string $class = "";
    public ?bool $checked;

    public function __construct(
        string $name,
        string $label,
        string $icon = "",
        string $class = "",
        bool $checked = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->class = $class;
        $this->checked = $checked;
    }

    public function render()
    {
        return view('components.form-checkbox');
    }
}
