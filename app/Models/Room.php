<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function beds()
    {
        return $this->belongsToMany(Bed::class)->withPivot('count');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function equipment()
    {
        return $this->morphToMany(Equipment::class, 'equipables', 'equipment_hotel_room')->withPivot('description');
    }
}
