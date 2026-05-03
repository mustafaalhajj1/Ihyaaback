<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function booths()
    {
        return $this->hasMany(Booth::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}