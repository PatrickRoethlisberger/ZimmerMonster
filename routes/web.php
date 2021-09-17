<?php

use App\Http\Controllers\BedtypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ManageRoomController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TouristAssociationController;
use App\Models\Room;
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


Route::resource('room', RoomController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/debug', function () {
        dd(auth()->user()->team->hotels->first()->slug);

    });

    Route::prefix('manage')->name('manage.')->middleware(['isInTeam'])->group(function () {

        Route::get('/', function () {
            return view('manage.index');
        })->name('index');

        // Equipment Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('equipment', EquipmentController::class)->except('show', 'destroy');
        });

        // Bedtype Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('bedtype', BedtypeController::class)->except('show', 'destroy');
        });

        // TouristAssoication Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('touristAssociation', TouristAssociationController::class)->except('show', 'destroy');
        });

        // Hotel Management
        Route::middleware(['isInTeam:admin,tourist_association,hotel'])->group(function () {
            Route::resource('hotel', HotelController::class)->except('show', 'destroy');

            Route::get('hotel/{hotel}/room/', [ManageRoomController::class, 'index'])->name('room.index');
            Route::get('hotel/{hotel}/room/create', [ManageRoomController::class, 'create'])->name('room.create');
            Route::post('hotel/{hotel}/room/store', [ManageRoomController::class, 'store'])->name('room.store');
            Route::get('hotel/{hotel}/room/{room}/edit', [ManageRoomController::class, 'edit'])->name('room.edit');
            Route::put('hotel/{hotel}/room/{room}/update', [ManageRoomController::class, 'update'])->name('room.update');
        });

        // // Room Management
        // Route::middleware(['isInTeam:admin,tourist_association,hotel'])->group(function () {
        //     Route::resource('room', ManageRoomController::class)->except('index', 'show', 'destroy');
        // });


    });

});
