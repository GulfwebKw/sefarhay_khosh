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
