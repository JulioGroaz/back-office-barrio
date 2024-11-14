<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ChiSiamoController as AdminChiSiamoController;
use App\Http\Controllers\Admin\EventiController as AdminEventiController;
use App\Http\Controllers\HomeController as GuestHomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [GuestHomeController::class, 'index'])->name('home');

Route::middleware('auth')->name('admin.')->prefix('admin/')->group(function() {
    Route::get('menu/{menu}/edit', [AdminMenuController::class, 'edit'])->name('menu.edit');
    Route::resource('/menues', AdminMenuController::class);
    Route::resource('chisiamo', AdminChiSiamoController::class)->except(['show']);

    Route::resource('/events', AdminEventiController::class);

    // Rotta per mostrare un singolo evento tramite la vista 'showevents'
    Route::get('events/{event}/showevents', [AdminEventiController::class, 'show'])->name('admin.events.showevents');
});

