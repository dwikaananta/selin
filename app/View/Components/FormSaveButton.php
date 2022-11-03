<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSaveButton extends Component
{
    public $submit;
    public $linkBack;

    public function __construct($submit = true, $linkBack = false)
    {
        $this->submit = $submit;
        $this->linkBack = $linkBack;
    }

    public function render()
    {
        return view('components.form-save-button');
    }
}
