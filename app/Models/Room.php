<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
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
                'source' => ['hotel.name', 'name']
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
        return $this->belongsToMany(Bedtype::class, 'room_bedtype')->withPivot('count');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function equipments()
    {
        return $this->morphToMany(Equipment::class, 'equipables', 'equipment_hotel_room')->withPivot('description');
    }
}
