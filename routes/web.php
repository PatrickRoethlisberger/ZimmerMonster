<?php

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
        dd(auth()->user()->team->managesHotels->first()->slug);

    });

    Route::prefix('manage')->group(function () {

        // TouristAssoication Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('touristAssociation', TouristAssociationController::class);
        });


    });

});
