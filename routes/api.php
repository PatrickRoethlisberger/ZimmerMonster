<?php

use App\Http\Controllers\ReviewController;
use App\Http\Resources\HotelResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/hotel', function () {
    return new HotelResource(Hotel::all());
});

Route::get('/room', function () {
    return new RoomResource(Room::all());
});

Route::get('/review', function () {
    return new ReviewResource(Review::all());
});

Route::get('/review/{hotel}', function (Hotel $hotel) {
    return new ReviewResource(Review::where('hotel_id', $hotel->id)->get());
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
