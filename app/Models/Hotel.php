<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function equipment()
    {
        return $this->morphedByMany(Equipment::class, 'equipable', 'equipment_hotel_room')->withPivot('description');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
