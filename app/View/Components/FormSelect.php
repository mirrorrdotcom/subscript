<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public string $name;
    public ?string $type = "text";
    public ?string $label = "";
    public ?string $icon = "";
    public ?string $placeholder = "";
    public ?string $class = "";
    public ?string $autocomplete;
    public ?array $options;
    public $value;

    public function __construct(
        string $name,
        string $type = "text",
        ?string $label = "",
        ?string $icon = "",
        ?string $placeholder = "",
        ?string $class = "",
        ?string $autocomplete = "off",
        array $options = [],
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
        $this->options = $options;
    }

    public function render()
    {
        return view('components.form-select');
    }
}
