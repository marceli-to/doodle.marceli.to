<?php

namespace App\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public string $password = '';
    public string $error = '';

    public function login()
    {
        if ($this->password === config('app.doodle_password')) {
            session(['doodle_authenticated' => true]);
            return redirect()->route('home');
        }

        $this->error = 'Falsches Passwort';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
