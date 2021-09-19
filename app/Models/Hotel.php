<?php

namespace App\Models;

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
}
