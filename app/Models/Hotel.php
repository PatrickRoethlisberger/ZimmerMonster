<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [
        'id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function touristAssociation()
    {
        return $this->belongsTo(TouristAssociation::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function equipments()
    {
        return $this->morphToMany(Equipment::class, 'equipables', 'equipment_hotel_room')->withPivot('description');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Room::class, 'hotel_id', 'room_id');
    }

    public function upcommingReservations()
    {
        return $this->hasManyThrough(Reservation::class, Room::class, 'hotel_id', 'room_id')->where('from', '>=', Carbon::now())->orderBy('from', 'asc');
    }

    public function currentReservations()
    {
        return $this->hasManyThrough(Reservation::class, Room::class, 'hotel_id', 'room_id')->where('until', '>=', Carbon::now())->where('from', '<=', Carbon::now())->orderBy('from', 'asc');
    }
}
