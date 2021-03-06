<?php

use App\Http\Controllers\BedtypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ManageRoomCategoryController;
use App\Http\Controllers\ManageRoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TouristAssociationController;
use App\Models\Hotel;
use App\Models\Reservation;
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

Route::get('hotel', function () {
    return view('hotels.index', [
        'hotels' => Hotel::orderBy('name')->paginate(16),
    ]);
})->name('hotel.index');


Route::resource('room', RoomController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::resource('reservation', ReservationController::class)->only(['index']);

    Route::get('reservation/{reservation}/review', [ReviewController::class, 'create'])->name('review.create');
    Route::post('reservation/{reservation}/review', [ReviewController::class, 'store'])->name('review.store');

    Route::prefix('manage')->name('manage.')->middleware(['isInTeam'])->group(function () {

        Route::get('/', function () {
            return view('manage.index', [
                'hotels' => auth()->user()->team->hotels()->get(),
            ]);
        })->name('index');

        // Equipment Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('roomCategory', ManageRoomCategoryController::class)->except('show', 'destroy');
            Route::resource('equipment', EquipmentController::class)->except('show', 'destroy');
        });

        // Bedtype Management
        Route::middleware(['isInTeam:admin'])->group(function () {
            Route::resource('bedtype', BedtypeController::class)->except('show', 'destroy');
        });

        // TouristAssoication Management
        Route::middleware(['isInTeam:admin,tourist_association'])->group(function () {
            Route::resource('touristAssociation', TouristAssociationController::class)->except('show', 'destroy');
        });

        // Hotel Management
        Route::middleware(['isInTeam:admin,tourist_association,hotel'])->group(function () {
            Route::resource('hotel', HotelController::class)->except('destroy');
            Route::get('/hotel/{hotel}/equipment', [HotelController::class, 'editEquipment'])->name('hotel.equipment.edit');

            Route::get('hotel/{hotel}/room/', [ManageRoomController::class, 'index'])->name('room.index');
            Route::get('hotel/{hotel}/room/create', [ManageRoomController::class, 'create'])->name('room.create');
            Route::post('hotel/{hotel}/room/store', [ManageRoomController::class, 'store'])->name('room.store');
            Route::get('hotel/{hotel}/room/{room}/edit', [ManageRoomController::class, 'edit'])->name('room.edit');
            Route::put('hotel/{hotel}/room/{room}/update', [ManageRoomController::class, 'update'])->name('room.update');
        });


    });

});
