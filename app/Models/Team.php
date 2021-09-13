<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'from' => 'datetime',
        'until' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function teamInvitations()
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function parent()
    {
        return $this->belongsTo(Team::class, 'parent_id');
    }

    // functions for hotel teams

    public function hotel()
    {
        return $this->hasOne(Hotel::class);
    }

    // functions for touristAssociations

    public function touristAssociations()
    {
        return $this->hasManyOfDescendantsAndSelf(TouristAssociation::class);
    }

    // functions for touristAssociations or admin teams

    public function managesHotels()
    {
        return $this->hasManyOfDescendantsAndSelf(Hotel::class);
    }

}
