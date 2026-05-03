<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role_id'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    public function bookings()
    {
        return $this->hasMany(EventBooking::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}