<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    use Sluggable;
    use Filterable;

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

    public function scopeBooked($query, Carbon $from, Carbon $until)
    {
        return $query->whereHas('reservations', function ($query) use ($from, $until) {
            $query->where('from', '<=', $until)
                ->where('until', '>=', $from);
        });
    }

    public function scopeAvailable($query, Carbon $from, Carbon $until)
    {
        return $query->whereDoesntHave('reservations', function ($query) use ($from, $until) {
            $query->where('from', '<', $until)
            ->where('until', '>', $from);
        });



        // return $query->reservations()->where('reservation_date', '>=', $from)->where('reservation_date', '<=', $to)->count() === 0;
    }
}
