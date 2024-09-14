<?php

namespace App\Http\Livewire;

use App\Steps\BusinessStep;
use App\Steps\DocumentStep;
use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\UserStep;

class UserBusinessDocumentWizard extends WizardComponent
{
    public array $steps = [
        UserStep::class,
        BusinessStep::class,
        DocumentStep::class,
    ];

    public function model()
    {
    
        return auth()->user(); // Placeholder for the current user
    }

    // Optional reset, saving or other actions
}
