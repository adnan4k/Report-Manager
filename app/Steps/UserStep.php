<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class UserStep extends Step
{
    protected string $view = 'livewire.user-details-step';

    public function title(): string
    {
        return 'Customer Details';
    }
    public function mount()
    {
        $this->mergeState([
            'name' => $this->model->name,
            'email' => $this->model->email,
            'phone' => $this->model->phone,
            'address' => $this->model->address,
        ]);
    }
    public function icon(): string
    {
        return 'check';
    }


    public function validate()
    {
        return [
            [
                'state.name' => ['required', 'string', 'max:255'],
                'state.email' => ['required', 'email', 'max:255'],
                'state.phone' => ['required', 'string', 'max:15'],
                'state.address' => ['required', 'string', 'max:255'],
            ],
        ];
    }
}

