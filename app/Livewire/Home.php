<?php

namespace App\Livewire;

use App\Http\Controllers\PaymentController;
use App\Models\Application;
use App\Models\Country;
use App\Models\Package;
use App\Models\Status;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    use WithFileUploads;

    public $countries ;
    public $packages ;
    public $statuses ;

    public $passport ;
    public $face ;
    public $national_id ;
    public $national_id2 ;

    public $form ;
    public $messageAlert;

    protected $validationAttributes = [
        'form.name'=> '',
        'form.email'=> '',
        'form.phone'=> '',
        'form.country_id'=> '',
        'form.package_id'=> '',
        'form.gateway'=> '',
        'passport'=> '',
        'face'=> '',
        'national_id'=> '',
        'national_id2'=> '',
    ];
    public $rules = [
        'form.name'=> ['required' , 'string' ,'max:255'],
        'form.email'=> ['nullable' , 'email' ,'max:255'],
        'form.phone'=> ['required' , 'string' ,'max:255'],
        'form.country_id'=> ['required' , 'exists:countries,id'],
        'form.package_id'=> ['required' , 'exists:packages,id'],
        'form.gateway'=> ['required' , 'string' ,'max:255'],
        'passport'=> ['required' , 'image' ,'mimes:jpeg,png,jpg,gif,svg','mimetypes:image/jpeg,image/png,image/gif,image/svg+xml' ,'max:2048'],
        'face'=> ['required' , 'image' ,'mimes:jpeg,png,jpg,gif,svg','mimetypes:image/jpeg,image/png,image/gif,image/svg+xml' ,'max:2048'],
        'national_id'=> ['required' , 'image' ,'mimes:jpeg,png,jpg,gif,svg','mimetypes:image/jpeg,image/png,image/gif,image/svg+xml' ,'max:2048'],
        'national_id2'=> ['required' , 'image' ,'mimes:jpeg,png,jpg,gif,svg','mimetypes:image/jpeg,image/png,image/gif,image/svg+xml' ,'max:2048'],
    ];


    public function mount(){
        $this->countries = Country::query()->where('is_active' , 1)->orderBy('title_en')->get()->toArray();
        $this->packages = Package::query()->where('is_active' , 1)->orderBy('price')->get()->toArray();
        $this->statuses = Status::query()->orderBy('ordering')->get()->toArray();
        $this->messageAlert = '';
        $this->passport = null;
        $this->face = null;
        $this->national_id = null;
        $this->national_id2 = null;
        $this->form = [
            'name'=> '',
            'email'=> '',
            'phone'=> '',
            'country_id'=> '',
            'package_id'=> optional(optional($this->packages)[0])['id'],
            'gateway'=> 'creditcard',
        ];
    }


    public function save(){
        $this->validate();
        $package = Package::query()->where('is_active' , 1)->findOrFail($this->form['package_id']);
        assert($package instanceof Package);
        $application = new Application();
        $application->fill($this->form);
        do {
            $uuid = Str::uuid();
        } while ( Application::query()->where('uuid' , $uuid)->exists());
        $application->uuid = $uuid;
        $application->status_id = Settings::get('first_status');
        $application->price = $package->price;
        $application->passport = $this->passport->storePublicly($uuid) ;
        $application->face = $this->face->storePublicly($uuid) ;
        $application->national_id = $this->national_id->storePublicly($uuid);
        $application->national_id2 = $this->national_id2->storePublicly($uuid);
        File::moveDirectory(storage_path('app/'.$uuid) , storage_path('app/'.'public/'.$uuid ));
        $application->save();
        return redirect()->route('application.pay' , [ 'uuid' => $application->uuid , 'gateway'=> $application->gateway]);
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.guest');
    }
}
