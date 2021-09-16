<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAssociation extends Model
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

}
