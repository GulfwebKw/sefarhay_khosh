<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Country;
use App\Models\Package;
use App\Models\Status;
use Livewire\Component;

class Contacts extends Component
{
    public $form ;
    public $messageAlert;

    protected $validationAttributes = [
        'form.name'=> '',
        'form.email'=> '',
        'form.subject'=> '',
        'form.phone'=> '',
        'form.message'=> '',
    ];
    public $rules = [
        'form.name'=> ['required' , 'string' ,'max:255'],
        'form.email'=> ['required' , 'email' ,'max:255'],
        'form.subject'=> ['required' , 'string' ,'max:255'],
        'form.phone'=> ['nullable' , 'string' ,'max:255'],
        'form.message'=> ['required' , 'string' ,'max:255' ,'min:10'],
    ];



    public function mount(){
        $this->messageAlert = '';
        $this->form = [
            'name' => '',
            'email' => '',
            'subject' => '',
            'phone' => '',
            'message' => '',
        ];
    }

    public function save(){
        $this->validate();
        Contact::query()->create( $this->form );
        $this->reset();
        $this->messageAlert = __('message_send_successfully');
    }


    public function resetForm(){
        $this->messageAlert = '';
        $this->form = [
            'name' => '',
            'email' => '',
            'subject' => '',
            'phone' => '',
            'message' => '',
        ];
    }

    public function render()
    {
        return view('livewire.contacts')->layout('layouts.guest');
    }
}
