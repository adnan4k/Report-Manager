<?php

use Illuminate\Contracts\View\View;
use Vildanbina\LivewireWizard\WizardComponent;

class UserWizard extends WizardComponent
{
    public function render(): View
    {
        // Your rendering logic here
        return view('livewire.user-wizard');
    }
}


