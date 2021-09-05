<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAssociation extends Model
{
    use HasFactory;

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
