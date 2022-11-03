<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $name;
    public $type;
    public $defaultValue;

    public function __construct($label = '', $name = '', $type = 'text', $defaultValue = '') {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
