<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

    public function upcommingReservations()
    {
        return $this->hasMany(Reservation::class)->where('from', '>=', Carbon::now())->orderBy('from', 'asc');
    }

    public function currentReservations()
    {
        return $this->hasMany(Reservation::class)->where('until', '>=', Carbon::now())->orderBy('from', 'asc');
    }

    public function getBookedDatesAttribute()
    {
        $reservations = $this->hasMany(Reservation::class)->where('until', '>=', Carbon::now())->get();

        $dates = [];

        foreach ($reservations as $reservation) {
            $startDate = Carbon::parse($reservation->from);
            $endDate = Carbon::parse($reservation->until);
            array_push($dates, CarbonPeriod::create($startDate, $endDate)->toArray());
        }

        return(collect($dates)->flatten());
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
    }
}
