<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/language/{lang}/change', function ($lang){
    session()->put('locale', $lang);
    return redirect()->back();
})->name('changeLang');
Route::get('/test', function (){

});

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::view('/about-us', 'about-us')->name('about-us');
Route::get('/contacts', \App\Livewire\Contacts::class)->name('contacts');

Route::any('/application/{uuid}/gateway/callback', \App\Livewire\Contacts::class)->name('callBack');
Route::any('/application/{uuid}', \App\Livewire\Contacts::class)->name('application.show');
