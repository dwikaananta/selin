<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextarea extends Component
{
    public $label;
    public $name;
    public $defaultValue;

    public function __construct($label = '', $name = '', $defaultValue = '') {
        $this->label = $label;
        $this->name = $name;
        $this->defaultValue = $defaultValue;
    }

    public function render()
    {
        return view('components.form-textarea');
    }
}
