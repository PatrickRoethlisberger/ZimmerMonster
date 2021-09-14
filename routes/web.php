<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TouristAssociationController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/debug', function () {
        dd(auth()->user()->team->hotels->first()->slug);

    });

    Route::prefix('manage')->group(function () {

        // Equipment Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('equipment', EquipmentController::class);
        });

        // TouristAssoication Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('touristAssociation', TouristAssociationController::class);
        });

        // Hotel Management
        Route::middleware(['isInTeam:admin,tourist_association'])->group(function () {
            Route::resource('hotel', HotelController::class);
        });


    });

});
