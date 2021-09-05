<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function hotels()
    {
        return $this->morphedByMany(Hotel::class, 'equipables', 'equipment_hotel_room');
    }

    public function rooms()
    {
        return $this->morphedByMany(Room::class, 'equipables', 'equipment_hotel_room');
    }

}
