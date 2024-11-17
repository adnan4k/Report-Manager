<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public function changeCredentials($email, $password)
    {
        $user = Auth::user();
        if ($email !== $user->email) {
            $user->email = $email; // Update email
        }

        if (!empty($password)) {
            $user->password = Hash::make($password); // Hash the password before saving
        }

        $user->save();

        // Returning success to Alpine.js for feedback
        session()->flash('success', 'Your credentials have been updated successfully.');
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Credentials updated successfully.']);
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.change-password');
    }
}
