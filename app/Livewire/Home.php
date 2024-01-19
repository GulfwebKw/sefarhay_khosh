<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Package;
use App\Models\Status;
use Livewire\Component;

class Home extends Component
{
    public $countries ;
    public $packages ;
    public $statuses ;
    public function mount(){
        $this->countries = Country::query()->where('is_active' , 1)->orderBy('title_en')->get()->toArray();
        $this->packages = Package::query()->where('is_active' , 1)->orderBy('price')->get()->toArray();
        $this->statuses = Status::query()->orderBy('id')->get()->toArray();
    }
    public function render()
    {
        return view('livewire.home')->layout('layouts.guest');
    }
}
