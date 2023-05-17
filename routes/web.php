<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['throttle:100,1'])->group(function(){
    Route::get('/', App\Http\Livewire\Home::Class)->name('home');
    Route::get('/list', App\Http\Livewire\LoanList::Class)->name('list');
    Route::get('/form/{loan_id}', App\Http\Livewire\Home::Class)->name('home.loan_id');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
