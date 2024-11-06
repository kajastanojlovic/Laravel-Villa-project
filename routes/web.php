<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register/create',[RegisterController::class, 'create'])->name('register.create');
Route::post('/register/store',[RegisterController::class, 'store'])->name('register.store');


Route::get('/property/contact',[ContactController::class, 'create'])->name('contact');
Route::get('/properties',[PropertyController::class, 'index'])->name('properties');


Route::middleware(['auth'])->group(function () {
    Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');
});


Route::middleware(['auth', 'user'])->group(function ()
{
   Route::get('/property/filter/{id}', [PropertyController::class, 'filter'])->name('property.filter');

   Route::get('/schedule/visit',[ContactController::class, 'scheduleCreate'])->name('schedule.visit.create');
   Route::post('/schedule/{id}',[ContactController::class, 'scheduleVisit'])->name('schedule.visit');

});

Route::middleware(['auth','admin'])->group(function ()
{
    Route::get('/property/create/new',[PropertyController::class, 'create'])->name('property.create');
    Route::post('/property/store',[PropertyController::class, 'store'])->name('property.store');
    Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.delete');


    Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::post('/property/edit/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::get('/property/filter/{id}', [PropertyController::class, 'filter'])->name('property.filter');

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('log.file');
});
Route::middleware(['notauth'])->group(function() {

    Route::get('/login/create',[LoginController::class, 'create'])->name('login.create');
    Route::post('/login/store',[LoginController::class, 'store'])->name('login.store');
});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


