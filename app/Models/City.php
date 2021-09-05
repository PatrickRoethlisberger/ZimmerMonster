<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function touristAssociation()
    {
        return $this->hasMany(TouristAssociation::class);
    }
}
