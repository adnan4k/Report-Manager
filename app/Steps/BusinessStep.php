<?php

namespace App\Steps;

use App\Models\Business;
use Vildanbina\LivewireWizard\Components\Step;

class BusinessStep extends Step
{
    // Specify the view used by this step
    protected string $view = 'livewire.business-details';

    // Implement the required title method
    public function title(): string
    {
        return 'Business Details';
    }

    // Initialize state with default values
    public function mount()
    {
        $this->mergeState([
            'business_name' => '',
            'report_center' => '',
            'tin_number' => '',
            'price' => '',
            'taxtype_due_date' => ''
        ]);
    }

    // Save the business details
 

    // Validate input fields
    public function validate()
    {
        return [
            [
                'state.business_name' => ['required', 'string', 'max:255'],
                'state.report_center' => ['required', 'string', 'max:255'],
                'state.tin_number' => ['required', 'string', 'max:100'],
                'state.price' => ['required', 'numeric'],
                'state.taxtype_due_date' => ['required', 'date'],
            ],
        ];
    }
}
