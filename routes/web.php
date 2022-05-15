<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailFetchController;

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


Route::get('/',[EmailFetchController::class,'welcome']);
// Route::post('connect',[EmailFetchController::class,'index'])->name('connect');
Route::get('/emails',[EmailFetchController::class,'definition'])->name('emails');


//Route::post('search',[EmailFetchController::class,'custom_search'])->name('search');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



