<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','date','time','hall_id','capacity'];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function bookings()
    {
        return $this->hasMany(EventBooking::class);
    }

    public function comments()
    {
        return $this->hasMany(EventComment::class);
    }

    public function ratings()
    {
        return $this->hasMany(EventRating::class);
    }
}