<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use \HackerESQ\Settings\Facades\Settings as config;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Toggle;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';


    public $site_title_en ;
    public $site_title_fa ;
    public $email ;
    public $telephone ;
    public $work_time_fa ;
    public $work_time_en ;
    public $logo ;
    public $twitter ;
    public $facebook ;
    public $instagram ;
    public $sub_title_en ;
    public $sub_title_fa ;
    public $MYFATOORAH_IS_LIVE ;
    public $MYFATOORAH_API_KEY ;

    public $rules = [
        'site_title_en' => ['required' , 'string'],
        'site_title_fa' => ['required' , 'string'],
        'email' => ['required' , 'email'],
        'telephone' => ['required' , 'string'],
        'work_time_en' => ['required' , 'string'],
        'work_time_fa' => ['required' , 'string'],
        'logo' => ['nullable' , 'image'],
        'twitter' => ['nullable' , 'url'],
        'facebook' => ['nullable' , 'url'],
        'instagram' => ['nullable' , 'url'],
        'sub_title_en' => ['nullable' , 'string'],
        'sub_title_fa' => ['nullable' , 'string'],
        'MYFATOORAH_IS_LIVE' => ['nullable'],
        'MYFATOORAH_API_KEY' => ['nullable' , 'string'],
    ];
    protected $validationAttributes = [
        'site_title_en' => 'Site Title (En)',
        'site_title_fa' => 'Site Title (Fa)',
        'email' => 'Email',
        'telephone' => 'Telephone',
        'work_time_en' => 'Work time',
        'work_time_fa' => 'Work time',
        'logo' => 'Logo',
        'twitter' => 'twitter',
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'sub_title_en' => 'sub title (en)',
        'sub_title_fa' => 'sub title (fa)',
        'MYFATOORAH_IS_LIVE' => 'Gateway mode',
        'MYFATOORAH_API_KEY' => 'Myfatoorah API Key',
    ];


    public function mount()
    {
        $this->form->fill(config::get());
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('site_title_en')
                        ->label('Site Title (En)')
                        ->required(),
                    TextInput::make('site_title_fa')
                        ->label('Site Title (Fa)')
                        ->required(),
                    TextInput::make('telephone')
                        ->required(),
                    TextInput::make('email')
                        ->type('email')
                        ->required(),
                    TextInput::make('work_time_en')
                        ->required(),
                    TextInput::make('work_time_fa')
                        ->required(),
                    TextInput::make('twitter')
                        ->type('url')
                        ->nullable(),
                    TextInput::make('facebook')
                        ->type('url')
                        ->nullable(),
                    TextInput::make('instagram')
                        ->type('url')
                        ->nullable(),
                    TextInput::make('logo')
                        ->label('Logo')
                        ->type('file')
                        ->rule(['nullable' , 'image']),
                    TextInput::make('sub_title_en')
                        ->nullable(),
                    TextInput::make('sub_title_fa')
                        ->nullable(),
                ])
                ->columns(2),
            Section::make()
                ->label('Payment Gateway')
                ->schema([
                    TextInput::make('MYFATOORAH_API_KEY')
                        ->label('Myfatoorah API Key')
                        ->nullable(),
                    Toggle::make('MYFATOORAH_IS_LIVE')
                        ->label('Gateway in live mode? (Danger! In Production do not stay in red position!)')
                        ->inline(false)
                        ->onColor('success')
                        ->offColor('danger'),
                ])
                ->columns(2),
        ];
    }


    public function save()
    {
        $this->validate();
        $data = $this->form->getState() ;
        $carbon = now();
        if ( $data['logo'] instanceof TemporaryUploadedFile) {
            $logoPath = "public/". $carbon->year .'/'.$carbon->month.'/'.$carbon->day.'/'.'logo.' . $data['logo']->guessExtension();
            $data['logo']->storeAs($logoPath);
            $last_logo_image = config::get('logo');
            config::force()->set(['logo' => $logoPath]);
            File::delete($last_logo_image);
        }
        config::force()->set(collect($data)->except(['logo'])->toArray());
        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
