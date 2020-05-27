<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public string $name;
    public ?string $type = "text";
    public ?string $label = "";
    public ?string $icon = "";
    public ?string $placeholder = "";
    public ?string $class = "";
    public ?string $autocomplete;
    public $value;

    public function __construct(
        string $name,
        string $type = "text",
        ?string $label = "",
        ?string $icon = "",
        ?string $placeholder = "",
        ?string $class = "",
        ?string $autocomplete = "off",
        $value = null
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->autocomplete = $autocomplete;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
