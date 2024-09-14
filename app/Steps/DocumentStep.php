<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class DocumentStep extends Step
{
    protected string $view = 'livewire.document-upload';

    
    public function title(): string
    {
        return 'Document';
    }
    
    public function mount()
    {
        $this->mergeState([
            'documents' => []
        ]);
    }

    public function validate()
    {
        return [
            [
                'state.documents.*' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'], // Validate each document
            ],
        ];
    }
}
