<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Forgot Password | E-Thrifting')]
class ForgotPage extends Component
{
    public $email;
    public function save(){
        $this->validate([
            'email' =>'required|email|max:255|exists:users,email',
        ]);
        //send email here
        $status = Password::sendResetLink(['email' => $this->email]);
        if($status == Password::RESET_LINK_SENT){
            session()->flash('success', 'Email sent!');
            $this->email = '';
        }else{
            session()->flash('error', 'Email not sent!');
        }

    }
    public function render()
    {
        return view('livewire.auth.forgot-page');
    }
}
