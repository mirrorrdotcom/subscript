<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RtfEditor extends Component
{
    public string $name;
    public ?string $label = "";
    public ?string $icon = "";
    public ?string $placeholder = "";
    public ?string $class = "";
    public ?string $autocomplete;
    public ?int $key;
    public $value;

    public function __construct(
        string $name,
        ?string $label = "",
        ?string $icon = "",
        ?string $placeholder = "",
        ?string $class = "",
        ?string $autocomplete = "off",
        ?int $key = 1,
        $value = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->autocomplete = $autocomplete;
        $this->key = $key;
        $this->value = $value ? html_entity_decode($value) : "";
    }

    public function render()
    {
        return view('components.rtf-editor');
    }
}
