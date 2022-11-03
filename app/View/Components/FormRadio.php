<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRadio extends Component
{
    public $inline;
    public $label;
    public $name;
    public $dataArr;
    public $defaultValue;

    public function __construct($inline = false, $label = '', $name = '', $dataArr = [], $defaultValue = '')
    {
        $this->inline = $inline;
        $this->label = $label;
        $this->name = $name;
        $this->dataArr = $dataArr;
        $this->defaultValue = $defaultValue;
    }

    public function render()
    {
        return view('components.form-radio');
    }
}
